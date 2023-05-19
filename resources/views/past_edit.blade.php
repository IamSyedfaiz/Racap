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
                        <h1 class="h3 mb-0 text-gray-800">Past Date Edit</h1>
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Project (Step 3)</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('past.edit.change') }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label for="cname">Project name</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ @$project->project_name }}" required name="project_name"
                                                id="cname" aria-describedby="cname">
                                            @error('project_name')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="sdate">Project start date</label>
                                            <input type="date" value="{{ @$project->project_start_date }}" disabled
                                                class="form-control" name="project_start_date" id="sdate"
                                                aria-describedby="sdate">
                                        </div>
                                        <div class="form-group">
                                            <label for="edate">Project end date</label>
                                            <input type="date" class="form-control" name="project_end_date"
                                                value="{{ @$project->project_end_date }}" id="edate"
                                                aria-describedby="edate">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="cname">Select client</label>
                                            <select class="form-control" id="project_cname" name="client_id">
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('client_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Factory</label>
                                            <select class="form-control" id="factory_cname" name="factory_id">
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('factory_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div> --}}
                                        <input type="text" name="project_id" value="{{ @$project->id }}" hidden>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div><!-- Earnings (Monthly) Card Example -->


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


</x-app-layout>
