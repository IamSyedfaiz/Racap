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
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Project Details</h1>
                <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">AD-0001-001</h6>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Client : {{ @$products->client->name }}</li>
                                <li>Factory : {{ $products->factory->name }}</li>
                                <li>Brand : {{ $products->brand_name }}</li>
                                <li>Project : {{ @$products->project->project_name }}</li>
                                <li>Product : {{ @$products->product_name }}</li>
                                <li>Model : {{ @$products->modal_number }}</li>
                                <li>Start Date: {{ date('d-m-Y', strtotime(@$products->project->project_start_date)) }}
                                </li>
                                <li>End Date: {{ date('d-m-Y', strtotime(@$products->project->project_end_date)) }}</li>
                                {{-- <li>Expected Finishing Date: {{ $products->project->project_end_date }}</li> --}}
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h2>{{ $products->client->name }}</h2>
                    @if (@$latestEntry->getting_value == 'gp')
                        <p class="text-danger">Getting Pause</p>
                    @elseif (@$latestEntry->getting_value == 'gu')
                    @endif
                    <h4 class="small font-weight-bold">{{ @$filteredName->phase_name }}
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
                            <a href="{{ route('history.getting', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">Pause History</a>
                            <a href="{{ route('alert.calender', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">Alert Date</a>
                            <a href="{{ route('send.alert', ['id' => $products->id]) }}" type="button"
                                class="btn btn-primary">Send Alert</a>
                        </div>
                    </div>

                </div>





                <!-- Earnings (Monthly) Card Example -->

                <!-- Earnings (Monthly) Card Example -->


                <!-- Pending Requests Card Example -->
                <!--<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Trash</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-infobank-tab" data-toggle="pill"
                                data-target="#pills-infobank" type="button" role="tab"
                                aria-controls="pills-infobank" aria-selected="true">Info Bank</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-docs-tab" data-toggle="pill" data-target="#pills-docs"
                                type="button" role="tab" aria-controls="pills-docs" aria-selected="false">Project
                                Docs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-test-tab" data-toggle="pill" data-target="#pills-test"
                                type="button" role="tab" aria-controls="pills-test" aria-selected="false">Other
                                Docs</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-certs-tab" data-toggle="pill" data-target="#pills-certs"
                                type="button" role="tab" aria-controls="pills-certs" aria-selected="false">Final
                                Certifications</button>
                        </li> --}}

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-infobank" role="tabpanel"
                            aria-labelledby="pills-infobank-tab">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Info Bank</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>File Subject Name</th>
                                                    <th>File Format</th>
                                                    <th>View/Download</th>
                                                    <th>Date & Time of Upload</th>
                                                    <th>Deleted By</th>
                                                    <th>Remarks</th>
                                                    <th>Move To Trash</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($trashs as $trash)
                                                    @if ($trash->section == 'IB')
                                                        <tr>
                                                            <td>{{ $trash->file_subject }}</td>
                                                            <td>
                                                                {{ pathinfo(@$trash->getMedia('post_image')->first()->file_name, PATHINFO_EXTENSION) }}
                                                            </td>
                                                            <td><a href="{{ @$trash->getMedia('post_image')->first()->getUrl() }}"
                                                                    target="_blank"
                                                                    class="btn btn-primary btn-sm">View</a></td>
                                                            <td>{{ date('d-m-Y H:i:s', strtotime($trash->created_at)) }}
                                                            </td>
                                                            {{-- <td>{{ $trash->created_at }}</td> --}}
                                                            <td>
                                                                @if ($trash->deleBY->getRoleNames()->first() == 'Sub Admin')
                                                                    <img src="../img/admin.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->deleBY->getRoleNames()->first() == 'Consultant')
                                                                    <img src="../img/client.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->deleBY->getRoleNames()->first() == 'Client')
                                                                    <img src="../img/vendor.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @endif {{ $trash->deleBY->name }}
                                                            </td>
                                                            <td>{{ $trash->remark }}</td>
                                                            <td><a href="{{ route('restore.file', ['id' => $trash->id]) }}"
                                                                    class="btn btn-primary btn-sm">Restore</a>
                                                                @if (auth()->user()->getRoleNames()->first() == 'Sub Admin' ||
                                                                        auth()->user()->getRoleNames()->first() == 'Super Admin')
                                                                    <button class="bg-black" type="button"
                                                                        onclick="document.getElementById('myModal{{ $trash->id }}').showModal()"
                                                                        id="btn"
                                                                        style="background-color: black; border-radius: 5px;">

                                                                        <a href="#" class=" bg-black">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor" class="text-white"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                            </svg></a>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <dialog id="myModal{{ $trash->id }}">
                                                        <div class="flex flex-col w-full h-auto ">
                                                            <div
                                                                class="flex w-full h-auto mb-20 px-4 rounded text-center ">
                                                                Are You Sure Delete From Trash
                                                            </div>

                                                            <div class=" d-flex justify-content-end mt-4 ">

                                                                {{-- <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button> --}}

                                                                <a
                                                                    href="{{ route('final.delete', ['id' => $trash->id]) }}">

                                                                    <button
                                                                        onclick="document.getElementById('myModal').close();"
                                                                        class=" px-2 py-1 rounded-lg   hover:bg-opacity-50">OK</button>
                                                                </a>
                                                            </div>


                                                        </div>
                                                    </dialog>
                                                @endforeach




                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-docs" role="tabpanel" aria-labelledby="pills-docs-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Project Docs</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable2" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>File Subject Name</th>
                                                    <th>File Format</th>
                                                    <th>View/Download</th>
                                                    <th>Date & Time of Upload</th>
                                                    <th>Deleted By</th>
                                                    <th>Remarks</th>
                                                    <th>Move To Trash</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($trashs as $trash)
                                                    @if ($trash->section == 'D')
                                                        <tr>
                                                            <td>{{ $trash->file_subject }}</td>
                                                            <td>
                                                                {{-- {{ pathinfo(@$upload_file->getMedia('post_image')->first()->file_name, PATHINFO_EXTENSION) }} --}}

                                                            </td>
                                                            <td><a href="#" target="_blank"
                                                                    class="btn btn-primary btn-sm">View</a></td>
                                                            <td>{{ date('d-m-Y H:i:s', strtotime($trash->created_at)) }}
                                                            </td>
                                                            <td>
                                                                @if ($trash->deleBY->getRoleNames()->first() == 'Sub Admin')
                                                                    <img src="../img/admin.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->deleBY->getRoleNames()->first() == 'Consultant')
                                                                    <img src="../img/client.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->deleBY->getRoleNames()->first() == 'Client')
                                                                    <img src="../img/vendor.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @endif {{ $trash->deleBY->name }}
                                                            </td>
                                                            <td>{{ $trash->remark }}</td>
                                                            <td><a href="{{ route('restore.file', ['id' => $trash->id]) }}"
                                                                    class="btn btn-primary btn-sm">Restore</a>
                                                                @if (auth()->user()->getRoleNames()->first() == 'Sub Admin' ||
                                                                        auth()->user()->getRoleNames()->first() == 'Super Admin')
                                                                    <button class="bg-black" type="button"
                                                                        onclick="document.getElementById('myModalPD{{ $trash->id }}').showModal()"
                                                                        id="btn"
                                                                        style="background-color: black; border-radius: 5px;">

                                                                        <a href="#" class=" bg-black">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor" class="text-white"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                            </svg></a>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <dialog id="myModalPD{{ $trash->id }}">
                                                        <div class="flex flex-col w-full h-auto ">
                                                            <div
                                                                class="flex w-full h-auto mb-20 px-4 rounded text-center ">
                                                                Are You Sure Delete From Trash
                                                            </div>

                                                            <div class=" d-flex justify-content-end mt-4 ">

                                                                {{-- <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button> --}}

                                                                <a
                                                                    href="{{ route('final.delete', ['id' => $trash->id]) }}">

                                                                    <button
                                                                        onclick="document.getElementById('myModalPD').close();"
                                                                        class=" px-2 py-1 rounded-lg   hover:bg-opacity-50">OK</button>
                                                                </a>
                                                            </div>


                                                        </div>
                                                    </dialog>
                                                @endforeach



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-test" role="tabpanel" aria-labelledby="pills-test-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Other Docs</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable3" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>File Subject Name</th>
                                                    <th>File Format</th>
                                                    <th>View/Download</th>
                                                    <th>Date & Time of Upload</th>
                                                    <th>Deleted By</th>
                                                    <th>Remarks</th>
                                                    <th>Move To Trash</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($trashs as $trash)
                                                    @if ($trash->section == 'TR')
                                                        <tr>
                                                            <td>{{ $trash->file_subject }}</td>
                                                            <td>
                                                                {{-- {{ pathinfo(@$upload_file->getMedia('post_image')->first()->file_name, PATHINFO_EXTENSION) }} --}}

                                                            </td>
                                                            <td><a href="#" target="_blank"
                                                                    class="btn btn-primary btn-sm">View</a></td>
                                                            <td>{{ date('d-m-Y H:i:s', strtotime($trash->created_at)) }}
                                                            </td>
                                                            <td>
                                                                @if ($trash->deleBY->getRoleNames()->first() == 'Sub Admin')
                                                                    <img src="../img/admin.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->deleBY->getRoleNames()->first() == 'Consultant')
                                                                    <img src="../img/client.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->deleBY->getRoleNames()->first() == 'Client')
                                                                    <img src="../img/vendor.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @endif {{ $trash->deleBY->name }}
                                                            </td>
                                                            <td>{{ $trash->remark }}</td>
                                                            <td><a href="{{ route('restore.file', ['id' => $trash->id]) }}"
                                                                    class="btn btn-primary btn-sm">Restore</a>

                                                                @if (auth()->user()->getRoleNames()->first() == 'Sub Admin' ||
                                                                        auth()->user()->getRoleNames()->first() == 'Super Admin')
                                                                    <button class="bg-black" type="button"
                                                                        onclick="document.getElementById('myModalOD{{ $trash->id }}').showModal()"
                                                                        id="btn"
                                                                        style="background-color: black; border-radius: 5px;">

                                                                        <a href="#" class=" bg-black">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor" class="text-white"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                            </svg></a>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <dialog id="myModalOD{{ $trash->id }}">
                                                        <div class="flex flex-col w-full h-auto ">
                                                            <div
                                                                class="flex w-full h-auto mb-20 px-4 rounded text-center ">
                                                                Are You Sure Delete From Trash
                                                            </div>

                                                            <div class=" d-flex justify-content-end mt-4 ">

                                                                {{-- <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button> --}}

                                                                <a
                                                                    href="{{ route('final.delete', ['id' => $trash->id]) }}">

                                                                    <button
                                                                        onclick="document.getElementById('myModalOD').close();"
                                                                        class=" px-2 py-1 rounded-lg   hover:bg-opacity-50">OK</button>
                                                                </a>
                                                            </div>


                                                        </div>
                                                    </dialog>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Page Wrapper -->

</x-app-layout>
