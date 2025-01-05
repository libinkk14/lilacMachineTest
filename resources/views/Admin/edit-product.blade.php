@extends('Admin.layout.app')

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Edit Product</h3>
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Product Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" id="product_name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Price</label>
                                        <input type="number" id="product_price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_quantity">Quantity</label>
                                        <input type="number" id="product_quantity" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_description">Description</label>
                                        <textarea id="product_description" name="descripition" class="form-control">{{ old('descripition', $product->descripition) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('admin.products.list') }}" class="btn btn-secondary">Back to Product</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
