<!DOCTYPE html>
<html>
@include("admin/layout/head")
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include("admin/layout/nav")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("admin/layout/main-sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger px-3 py-1">
                            @foreach ($errors->all() as $error)
                                <h5 class="m-0">{{ $error }}</h5>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All products</h3>
                            <button class="btn btn-primary float-right px-4 py-2" data-toggle="modal"
                            data-target="#modal-new-product">Create new product</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-product" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Thumbnail</th>
                                    <th>Gallery</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $pro)
                                <tr>
                                    <td data-target="id">{{ $pro->id }}</td>
                                    <td data-target="product_name">{{ $pro->product_name }}</td>
                                    <td data-target="product_desc" style="max-width: 200px" class="ellipsis">{{ $pro->product_desc }}</td>
                                    <td data-target="product_thumbnail" style="max-width: 200px" class="ellipsis">{{ $pro->product_thumbnail }}</td>
                                    <td data-target="product_gallery" style="max-width: 200px" class="ellipsis">{{ $pro->product_gallery }}</td>
                                    <td data-target="brand_name">{{ $pro->Brand->brand_name }}</td>
                                    <td data-target="category_name">{{ $pro->Category->category_name }}</td>
                                    <td data-target="quantity" class="number">{{ $pro->quantity }}</td>
                                    <td data-target="price" class="number">{{ number_format($pro->price, 2) }}</td>
                                    <td>{{ $pro->created_at }}</td>
                                    <td>{{ $pro->updated_at }}</td>
                                    <td class="d-flex justify-content-around">
                                        <a data-toggle="modal" data-target="#modal-edit-product"><i class="far fa-edit"></i></a>
                                        <a data-toggle="modal" data-target="#modal-delete-product"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <p>Không có cột</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-new-product">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/products/create') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create new product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product name</label>
                        <input name="product_name" class="form-control" placeholder="Enter product name" value="{{ old('product_name') }}">
                    </div>
                    <div class="form-group">
                        <label>Product description</label>
                        <input name="product_desc" class="form-control" placeholder="Enter product description" value="{{ old('product_desc') }}">
                    </div>
                    <div class="form-group">
                        <label>Product thumbnail</label>
                        <input name="product_thumbnail" class="form-control" placeholder="Enter product thumbnail" value="{{ old('product_thumbnail') }}">
                    </div>
                    <div class="form-group">
                        <label>Product gallery</label>
                        <input name="product_gallery" class="form-control" placeholder="Enter product gallery" value="{{ old('product_gallery') }}">
                    </div>
                    <div class="form-group">
                        <label>Brand name</label>
                        <select name="brand_id" class="form-control">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category name</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input name="quantity" class="form-control" placeholder="Enter quantity" value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" class="form-control" placeholder="Enter price" value="{{ old('price') }}">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-edit-product">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/products/edit') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product name</label>
                        <input name="product_name" class="form-control" placeholder="Enter product name" value="{{ old('product_name') }}">
                    </div>
                    <div class="form-group">
                        <label>Product description</label>
                        <input name="product_desc" class="form-control" placeholder="Enter product description" value="{{ old('product_desc') }}">
                    </div>
                    <div class="form-group">
                        <label>Product thumbnail</label>
                        <input name="product_thumbnail" class="form-control" placeholder="Enter product thumbnail" value="{{ old('product_thumbnail') }}">
                    </div>
                    <div class="form-group">
                        <label>Product gallery</label>
                        <input name="product_gallery" class="form-control" placeholder="Enter product gallery" value="{{ old('product_gallery') }}">
                    </div>
                    <div class="form-group">
                        <label>Brand name</label>
                        <select name="brand_name" class="form-control">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category name</label>
                        <select name="category_name" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input name="quantity" class="form-control" placeholder="Enter quantity" value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" class="form-control" placeholder="Enter price" value="{{ old('price') }}">
                    </div>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-delete-product">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/products/delete') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    @include("admin/layout/footer")

    <!-- Control Sidebar -->
    @include("admin/layout/sidebar")
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include("admin/layout/scripts")
</body>
</html>
