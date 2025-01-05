@extends('Admin.layout.app')

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Product Details</h3>
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $product->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
                                <p><strong>Quantity:</strong> {{ $product->stock_quantity }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Description:</strong></p>
                                <p>{{ $product->descripition }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.products.list') }}" class="btn btn-secondary">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
