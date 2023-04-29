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


            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Project Details</h1>
                <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ @$products->modal_number }}</h6>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Project : {{ @$products->project->project_name }}</li>
                                <li>Product : {{ @$products->product_name }}</li>
                                <li>Factory : {{ $products->factory->name }}</li>
                                {{-- <li>No of Application : 001</li> --}}
                                <li>Brand : {{ @$products->client->name }}</li>
                                <li>Model : {{ @$products->modal_number }}</li>
                                <li>Start Date: {{ @$products->project->project_start_date }}</li>
                                <li>Standard Due Date: {{ @$products->project->project_end_date }}</li>
                                {{-- <li>Expected Finishing Date: {{ @$products->project->project_end_date }}</li> --}}
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h2>Client Name</h2>
                    <h4 class="small font-weight-bold">Test Reports
                        <span class="float-right">{{ @$calculatedPercentage }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ @$calculatedPercentage }}%" aria-valuenow="50" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>

                    <hr>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('project.details', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">Message Center</a>
                            <a href="{{ route('view.files', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">View
                                Files</a>
                            <a href="{{ route('view.account', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">View
                                Accounts</a>
                            <a href="{{ route('view.trash', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">View
                                Trash</a>
                            <a href="{{ route('project.status', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">Status</a>
                        </div>
                    </div>

                </div>
            </div>
            <form action="{{ route('post.status') }}" method="post">
                @csrf
                <div class="row ">

                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Add Phase</h6>
                            </div>
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Phase</label>
                                    <select id="myDropdown" class="form-control" name="select_phase">
                                        <option>Select Phase</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select>
                                </div>
                                <input type="text" hidden name="product_id" value="{{ $products->id }}">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div><!-- Earnings (Monthly) Card Example -->
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Add Name</h6>
                            </div>
                            <div class="card-body" id="inputFields">
                            </div>
                        </div>

                    </div><!-- Earnings (Monthly) Card Example -->


                </div>
            </form>
            <div class="">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Project Docs</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Phase Name</th>
                                        <th>stutas</th>
                                        <th>In Complete</th>
                                        <th>Completed</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($progressreports)
                                        @foreach (@$progressreports as $progressreport)
                                            <tr>
                                                <td>{{ $progressreport->phase_name }}
                                                </td>
                                                <td>
                                                    @if ($progressreport->is_completed == 'Y')
                                                        <a href="{{ route('change.status', ['id' => $progressreport->id]) }}"
                                                            class="btn btn-success text-white mr-2">Done</a>
                                                    @endif
                                                </td>
                                                @if ($progressreport->is_completed == 'Y')
                                                    <td>
                                                        <button class="btn btn-danger">
                                                            <svg fill="#000000" viewBox="0 0 200 200"
                                                                data-name="Layer 1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <title></title>
                                                                <path
                                                                    d="M114,100l49-49a9.9,9.9,0,0,0-14-14L100,86,51,37A9.9,9.9,0,0,0,37,51l49,49L37,149a9.9,9.9,0,0,0,14,14l49-49,49,49a9.9,9.9,0,0,0,14-14Z">
                                                                </path>

                                                            </svg>
                                                        </button>
                                                    </td>
                                                    <td>-</td>
                                                @endif

                                                @if ($progressreport->is_completed == 'N')
                                                    <td>-</td>

                                                    <td><button class="btn btn-success"><svg viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4"
                                                                    d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z"
                                                                    fill="#292D32"></path>
                                                                <path
                                                                    d="M10.5795 15.5801C10.3795 15.5801 10.1895 15.5001 10.0495 15.3601L7.21945 12.5301C6.92945 12.2401 6.92945 11.7601 7.21945 11.4701C7.50945 11.1801 7.98945 11.1801 8.27945 11.4701L10.5795 13.7701L15.7195 8.6301C16.0095 8.3401 16.4895 8.3401 16.7795 8.6301C17.0695 8.9201 17.0695 9.4001 16.7795 9.6901L11.1095 15.3601C10.9695 15.5001 10.7795 15.5801 10.5795 15.5801Z"
                                                                    fill="#292D32"></path>

                                                            </svg></button></td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    @endif
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
    <!-- End of Page Wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myDropdown').on('change', function() {
                var selectedValue = $(this).val();
                var inputFields = '';

                if (selectedValue == 1) {
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase One Name</label>
                                <input type="text" name="phase_name[1]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                } else if (selectedValue == 2) {
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase One Name</label>
                                <input type="text" name="phase_name[1]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Two Name</label>
                                <input type="text" name="phase_name[2]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                } else if (selectedValue == 3) {
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase One Name</label>
                                <input type="text" name="phase_name[1]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Two Name</label>
                                <input type="text" name="phase_name[2]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Three Name</label>
                                <input type="text" name="phase_name[3]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                } else if (selectedValue == 4) {
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase One Name</label>
                                <input type="text" name="phase_name[1]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Two Name</label>
                                <input type="text" name="phase_name[2]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Three Name</label>
                                <input type="text" name="phase_name[3]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Four Name</label>
                                <input type="text" name="phase_name[4]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                } else if (selectedValue == 5) {
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase One Name</label>
                                <input type="text" name="phase_name[1]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Two Name</label>
                                <input type="text" name="phase_name[2]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Three Name</label>
                                <input type="text" name="phase_name[3]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Four Name</label>
                                <input type="text" name="phase_name[4]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                    inputFields += `<div class="form-group">
                                <label for="exampleFormControlInput1">Phase Five Name</label>
                                <input type="text" name="phase_name[5]" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Phase Name">
                            </div>`;
                } else {
                    inputFields;
                }

                $('#inputFields').html(inputFields);
            });
        });
    </script>
</x-app-layout>
