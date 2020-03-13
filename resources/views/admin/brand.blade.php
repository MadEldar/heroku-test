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
                        <h1>Brands</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ol>
                    </div>
                    @if(isset($errors) && $errors->has('brand_name'))
                        <div class="alert alert-danger px-3 py-1">
                            <h5 class="m-0">{{ $errors->first('brand_name') }}</h5>
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
                            <h3 class="card-title">All brands</h3>
                            <button class="btn btn-primary float-right px-4 py-2" data-toggle="modal"
                            data-target="#modal-new-brand">Create new brand</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-brand" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($brands as $brand)
                                <tr>
                                    <td data-target="id">{{ $brand->id }}</td>
                                    <td data-target="brand_name">{{ $brand->brand_name }}</td>
                                    <td>{{ $brand->created_at }}</td>
                                    <td>{{ $brand->updated_at }}</td>
                                    <td><a data-toggle="modal" data-target="#modal-edit-brand">Edit</a></td>
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

    <div class="modal fade" id="modal-new-brand">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/brands/create') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create new brand</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Brand name</label>
                        <input name="brand_name" class="form-control" placeholder="Enter brand name" value="{{ old('brand_name') }}">
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

    <div class="modal fade" id="modal-edit-brand">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/brands/edit') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit brand</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Brand name</label>
                        <input name="brand_name" class="form-control" placeholder="Enter brand name" value="{{ old('brand_name') }}">
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

    @include("admin/layout/footer")

    <!-- Control Sidebar -->
    @include("admin/layout/sidebar")
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include("admin/layout/scripts")
</body>
</html>
