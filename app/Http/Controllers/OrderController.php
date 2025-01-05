<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $product = Product::find($productId);

        if (!$product || $product->stock_quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Product is out of stock.']);
        }

        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        $product->stock_quantity -= 1;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Product added to cart successfully.']);
    }

    public function showCart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        return view('User.cart')->with([
            'cartItems' => $cartItems,
        ]);
    }

    public function removeCartItem(Request $request)
    {
        $cartItem = Cart::find($request->cart_id);

        if ($cartItem) {
            $product = Product::find($cartItem->product_id);
            $product->stock_quantity += $cartItem->quantity;
            $product->save();

            $cartItem->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

    public function placeOrder()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty']);
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return response()->json(['success' => true, 'message' => 'Order placed successfully']);
    }
}
