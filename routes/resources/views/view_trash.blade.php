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
                        <p class="text-success">Getting Unpause</p>
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
                                class="btn btn-primary">History Getting</a>
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

                                                                <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button>

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

                                                                <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button>

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

                                                                <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button>

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
                        {{-- <div class="tab-pane fade" id="pills-certs" role="tabpanel"
                            aria-labelledby="pills-certs-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Final Certification</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable4" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>File Subject Name</th>
                                                    <th>File Format</th>
                                                    <th>View/Download</th>
                                                    <th>Date & Time of Upload</th>
                                                    <th>Uploaded By</th>
                                                    <th>Remarks</th>
                                                    <th>Move To Trash</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($trashs as $trash)
                                                    @if ($trash->section == 'FC')
                                                        <tr>
                                                            <td>{{ $trash->file_subject }}</td>
                                                            <td>
                                                            </td>
                                                            <td><a href="#" target="_blank"
                                                                    class="btn btn-primary btn-sm">View</a></td>
                                                            <td>{{ $trash->created_at }}</td>
                                                            <td>
                                                                @if ($trash->user->getRoleNames()->first() == 'Sub Admin')
                                                                    {{ pathinfo(@$upload_file->getMedia('post_image')->first()->file_name, PATHINFO_EXTENSION) }}
                                                                    <img src="/img/admin.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->user->getRoleNames()->first() == 'Consultant')
                                                                    <img src="/img/client.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @elseif ($trash->user->getRoleNames()->first() == 'Client')
                                                                    <img src="/img/vendor.jpg" class="rounded mr-0"
                                                                        alt="...">
                                                                @endif
                                                                {{ $trash->user->name }}
                                                            </td>
                                                            <td>{{ $trash->remark }}</td>
                                                            <td><a href="{{ route('restore.file', ['id' => $trash->id]) }}"
                                                                    class="btn btn-primary btn-sm">Restore</a>
                                                                @if ($trash->user->getRoleNames()->first() == 'Sub Admin')
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
                                                            /final_delete/{{$trash->id}}
                                                        </tr>
                                                    @endif

                                                    <dialog id="myModal{{ $trash->id }}">
                                                        <div class="flex flex-col w-full h-auto ">
                                                            <div
                                                                class="flex w-full h-auto mb-20 px-4 rounded text-center ">
                                                                Are You Sure Delete From Trash
                                                            </div>

                                                            <div class=" d-flex justify-content-end mt-4 ">

                                                                <button
                                                                    onclick="document.getElementById('myModal{{ $trash->id }}').close();"
                                                                    class="mr-2 px-2 py-1 rounded-lg "
                                                                    data-modal-toggle="default-modal">Cancel</button>

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
                        </div> --}}

                    </div>







                </div>
            </div>




            <!--<div class="row">

                        
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

            <!-- Content Row -->
            <!--<div class="row">

                        
                        <div class="col-lg-6 mb-4">

                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>-->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

</x-app-layout>
