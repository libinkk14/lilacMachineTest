<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $cartCount = $user ? Cart::where('user_id', $user->id)->count() : 0; 
        $products = Product::whereNotNull('stock_quantity')->where('delete', null)->get();
        return view('User.index')->with([
            'cartCount' => $cartCount,
            'products' => $products,
            'isAuthenticated' => $user ? true : false, 
        ]);
    }
}
