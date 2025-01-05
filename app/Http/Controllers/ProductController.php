<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function addProductForm()
    {
        return view('Admin.add-product');
    }

    public function storeProduct(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity,
                'descripition' => $request->description,
            ];

            Product::create($data);

            return back()->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Product added failed. Please try again.');
        }
    }

    public function productsList()
    {
        $products = Product::where('delete', null)->get();
        return view('Admin.list-product')->with(['products' => $products]);
    }

    public function viewProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return view('Admin.view-product')->with(['product' => $product]);
    }

    public function editProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return view('Admin.edit-product')->with(['product' => $product]);
    }

    public function updateProduct($id, Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity,
                'descripition' => $request->descripition,
            ];

            Product::where('id', $id)->update($data);
            return redirect()->route('admin.products.list')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Product updated failed. Please try again.');
        }
    }

    public function deleteProduct($id)
    {
        try {
            Product::where('id', $id)->update(['delete' => 1]);
            return back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
}
