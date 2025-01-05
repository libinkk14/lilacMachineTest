<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function fetchCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)
            ->with('product:id,name,descripition,price')
            ->get()
            ->map(function ($cartItem) {
                return [
                    'id' => $cartItem->id,
                    'user_id' => $cartItem->user_id,
                    'name' => $cartItem->product->name,
                    'descripition' => $cartItem->product->descripition,
                    'price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                    'created_at' => $cartItem->created_at,
                    'updated_at' => $cartItem->updated_at
                ];
            });

        return response()->json($cart);
    }

    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        if ($product->stock_quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Product is out of stock.'], 400);
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

        $cartCount = $user ? Cart::where('user_id', $user->id)->count() : 0;

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart count' => $cartCount,
        ]);
    }

    public function removeCartItem(Request $request)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)->find($request->cart_id);

        if ($cartItem) {
            $product = Product::find($cartItem->product_id);
            if ($product) {
                $product->stock_quantity += $cartItem->quantity;
                $product->save();

                $cartItem->delete();

                return response()->json(['success' => true, 'message' => 'Item removed from cart successfully.']);
            }

            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
    }

    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
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

        return response()->json(['success' => true, 'message' => 'Order placed successfully'], 201);
    }
}
