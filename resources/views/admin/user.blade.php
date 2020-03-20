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
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">All users</h3>
                            <button class="btn btn-primary float-right px-4 py-2" data-toggle="modal"
                            data-target="#modal-new-user">Create new user</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-user" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Verified at</th>
                                    <th>Deactivated at</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td data-target="id">{{ $user->id }}</td>
                                    <td data-target="name">{{ $user->name }}</td>
                                    <td data-target="email">{{ $user->email }}</td>
                                    <td data-target="role">{{ $user->role }}</td>
                                    <td data-target="email_verified_at">{{ $user->email_verified_at }}</td>
                                    <td data-target="deactivated_at">{{ $user->deactivated_at }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td class="d-flex justify-content-around">
                                        <a data-toggle="modal" data-target="#modal-edit-user"><i class="far fa-edit"></i></a>
                                        <a data-toggle="modal" data-target="#modal-delete-user"><i class="far fa-trash-alt"></i></a>
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

    <div class="modal fade" id="modal-new-user">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/users/create') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create new user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>User name</label>
                        <input name="name" class="form-control" placeholder="Enter user name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>User email</label>
                        <input name="email" class="form-control" placeholder="Enter user email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label>User password</label>
                        <input name="password" class="form-control" placeholder="Enter user password" value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <label>User role</label>
                        <input name="role" class="form-control" placeholder="Enter user email" value="{{ old('role') }}">
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

    <div class="modal fade" id="modal-edit-user">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/users/edit') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>User name</label>
                        <input name="name" class="form-control" placeholder="Enter user name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>User email</label>
                        <input name="email" class="form-control" placeholder="Enter user email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label>User role</label>
                        <input name="role" class="form-control" placeholder="Enter user role" value="{{ old('role') }}">
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

    <div class="modal fade" id="modal-delete-user">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('/admin/users/delete') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
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
