<x-app-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create Teams</h1>
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add (Client) User to project </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('create.client.user') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cname">User name</label>
                                            <input type="text" class="form-control" required name="user_name"
                                                id="cname" aria-describedby="cname">
                                            @error('user_name')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">User email</label>
                                            <input type="text" class="form-control" required name="client_email"
                                                id="cname" aria-describedby="cname">
                                            @error('client_email')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="cname">User Password</label>
                                            <input type="password" class="form-control" required name="client_password"
                                                id="cname" aria-describedby="cname">
                                            @error('client_password')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="cname">User Mobile Number</label>
                                            <input type="number" class="form-control" name="client_mobile_number"
                                                id="cname" aria-describedby="cname">
                                            @error('client_mobile_number')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">User Landline Number</label>
                                            <input type="number" class="form-control" name="client_landline_number"
                                                id="cname" aria-describedby="cname">
                                            @error('client_landline_number')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add (Consultant) User to product</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('create.consultant.user') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cname">User Name</label>
                                            <input type="text" class="form-control" required name="user_name"
                                                id="cname" aria-describedby="cname">
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">User Email</label>
                                            <input type="text" class="form-control" required name="consultant_email"
                                                id="cname" aria-describedby="cname">
                                            @error('consultant_email')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="cname">User Password</label>
                                            <input type="password" class="form-control" required
                                                name="consultant_password" id="cname" aria-describedby="cname">
                                            @error('consultant_password')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="cname">User Mobile Number</label>
                                            <input type="number" class="form-control" name="consultant_mobile_number"
                                                id="cname" aria-describedby="cname">
                                            @error('consultant_mobile_number')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">User Landline Number</label>
                                            <input type="number" class="form-control" name="consultant_landline_number"
                                                id="cname" aria-describedby="cname">
                                            @error('consultant_landline_number')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>





                        <!-- Earnings (Monthly) Card Example -->

                        <!-- Earnings (Monthly) Card Example -->

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">View Teams</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    {{-- <th>Password</th> --}}
                                                    <th>Moblie Number</th>
                                                    <th>Landline Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach (@$users as $user)
                                                    @if ($user->getRoleNames()->first() == 'Client')
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            {{-- <td>{{ $user->password }}</td> --}}
                                                            <td>{{ $user->mobile_number }}</td>
                                                            <td>{{ $user->landline_number }}</td>
                                                            <td>
                                                                @if (@$user->active !== 'N')
                                                                    <form
                                                                        action="{{ route('change.active', ['id' => $user->id, 'status' => 'N']) }}"
                                                                        method="post" class="inline-block">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <span>Suspend</span>
                                                                            <i class="fas fa-user-slash "></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                @if (@$user->active !== 'Y')
                                                                    <form
                                                                        action="{{ route('change.active', ['id' => $user->id, 'status' => 'Y']) }}"
                                                                        method="post" class="inline-block">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-primary">
                                                                            <span>Active</span>
                                                                            <i class="fas fa-user-check"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                            {{-- <td><a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                                                    class="btn btn-primary btn-sm">Delete</a>
                                                            </td> --}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Consultants</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    {{-- <th>Password</th> --}}
                                                    <th>Moblie Number</th>
                                                    <th>Landline Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach (@$users as $user)
                                                    @if ($user->getRoleNames()->first() == 'Consultant')
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            {{-- <td>{{ $user->password }}</td> --}}

                                                            <td>{{ $user->mobile_number }}</td>
                                                            <td>{{ $user->landline_number }}</td>
                                                            <td>
                                                                @if (@$user->active !== 'N')
                                                                    <form
                                                                        action="{{ route('change.active', ['id' => $user->id, 'status' => 'N']) }}"
                                                                        method="post" class="inline-block">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <span>Suspend</span>
                                                                            <i class="fas fa-user-slash "></i>

                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                @if (@$user->active !== 'Y')
                                                                    <form
                                                                        action="{{ route('change.active', ['id' => $user->id, 'status' => 'Y']) }}"
                                                                        method="post" class="inline-block">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-primary">
                                                                            <span>Active</span>
                                                                            <i class="fas fa-user-check"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                            {{-- <td><a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                                                    class="btn btn-primary btn-sm">Delete</a>
                                                            </td> --}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RACAP 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
