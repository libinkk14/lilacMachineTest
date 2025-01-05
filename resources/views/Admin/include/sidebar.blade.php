<div class="sidebar" id="sidebar">
    <h4 class="text-center py-3">Menu</h4>
    <a href="index.html">Dashboard</a>
    <a href="#productManagement" data-bs-toggle="collapse">Product Management <i class="fas fa-chevron-down float-end"></i></a>
    <div class="collapse" id="productManagement">
        <a href="{{route('admin.products.list')}}" class="ms-3">View Products</a>
        <a href="{{route('add.products.form')}}" class="ms-3">Add Products</a>
    </div>
</div>
