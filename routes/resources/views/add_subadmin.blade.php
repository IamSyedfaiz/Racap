<x-app-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @if ($roles === 'Super Admin')
            @include('layouts.sidebar')
        @elseif($roles === 'Sub Admin')
            @include('layouts.sidebar')
        @elseif($roles === 'Client')
            @include('layouts.client_sidebar')
        @elseif($roles === 'Consultant')
            @include('layouts.consultant_sidebar')
        @endif
        <!-- End of Sidebar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Add Sub Admin</h1>
                <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="container-fluid">

                    <!-- Page Heading -->


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Subadmin</h6>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form action="{{ route('add.subadmin') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cname">User name</label>
                                            <input type="text" class="form-control" name="user_name" id="cname"
                                                aria-describedby="cname">
                                            @error('user_name')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">User email</label>
                                            <input type="text" class="form-control" name="user_email" id="cname"
                                                aria-describedby="cname">
                                            @error('user_email')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Amount</label>
                                            <input type="text" class="form-control" name="amount" id="cname"
                                                value="$100" aria-describedby="cname">
                                            @error('amount')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{--  <div class="form-group">
                                            <label for="cname">Current Date</label>
                                            <input type="text" class="form-control"  name="current_date"
                                                id="cname" value="{{ $currentDate }}" aria-describedby="cname">
                                            @error('current_date')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="cname">Expire by</label>
                                            <select class="form-control" id="client_product_name" name="expire_by">
                                                <option value="">Select An Option</option>
                                                <option value="{{ $one_year }}">1 Year</option>
                                                <option value="{{ $two_year }}">2 Year</option>
                                                <option value="{{ $five_year }}">5 Year</option>
                                            </select>
                                            @error('product_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Page Wrapper -->

</x-app-layout>
