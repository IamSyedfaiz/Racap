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
                                <li>Client : {{ @$products->client->name }}</li>
                                <li>Factory : {{ @$products->factory->name }}</li>
                                <li>Brand : {{ @$products->brand_name }}</li>
                                <li>Project : {{ @$products->project->project_name }}</li>
                                <li>Product : {{ @$products->product_name }}</li>
                                <li>Model : {{ @$products->modal_number }}</li>
                                <li>Start Date: {{ date('d-m-Y', strtotime(@$products->project->project_start_date)) }}
                                </li>
                                <li>End Date: {{ date('d-m-Y', strtotime(@$products->project->project_end_date)) }}</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h2>{{ @$products->client->name }}</h2>
                    @if (@$latestEntry->getting_value == 'gp')
                        <p class="text-danger">Getting Pause</p>
                    @elseif (@$latestEntry->getting_value == 'gu')
                        <p class="text-success">Getting Unpause</p>
                    @endif
                    <h4 class="small font-weight-bold">
                        {{ @$filteredName->phase_name }}
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
            </div>

            <!-- Content Row -->


            <div class="row">
                <div class="col-12">


                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-infobank" role="tabpanel"
                            aria-labelledby="pills-infobank-tab">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">History of Getting Pause & Unpause
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Project ID</th>
                                                    {{-- <th>Folder</th> --}}
                                                    <th class="text-danger">Getting Pause</th>
                                                    <th class="text-success">Getting Unpause</th>
                                                    <th>Reason</th>
                                                    <th>Updated By</th>
                                                </tr>
                                            </thead>
                                            @foreach ($history_gettings as $history_getting)
                                                <tr>
                                                    <td>{{ $history_getting->id }}</td>
                                                    <td>{{ $history_getting->product->modal_number }}</td>
                                                    {{-- <td>Docs</td> --}}
                                                    @if ($history_getting->getting_value == 'gp')
                                                        <td class="text-danger">{{ $history_getting->created_at }}</td>
                                                    @else
                                                        <td>--------------------------</td>
                                                    @endif
                                                    @if ($history_getting->getting_value == 'gu')
                                                        <td class="text-success">{{ $history_getting->created_at }}
                                                        </td>
                                                    @else
                                                        <td>----------------------------</td>
                                                    @endif
                                                    <td>{{ $history_getting->reason }}</td>
                                                    <td>
                                                        @if ($history_getting->user->getRoleNames()->first() == 'Sub Admin')
                                                            <img src="../img/admin.jpg" class="rounded mr-0"
                                                                alt="...">
                                                        @elseif ($history_getting->user->getRoleNames()->first() == 'Consultant')
                                                            <img src="../img/client.jpg" class="rounded mr-0"
                                                                alt="...">
                                                        @elseif ($history_getting->user->getRoleNames()->first() == 'Client')
                                                            <img src="../img/vendor.jpg" class="rounded mr-0"
                                                                alt="...">
                                                        @endif {{ $history_getting->user->name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tbody>




                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Update the Getting Pause & Unpause
                                    </h6>
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-5">
                                        <form action="{{ route('store.history.getting') }}" method="post">
                                            @csrf
                                            <div class="orm-group mb-10 d-flex flex-row">
                                                <div class="">
                                                    <input type="radio" name="getting_value" value="gp"
                                                        id="" class="mx-2">
                                                    <label class="font-weight-bold text-primary">Getting
                                                        Pause</label>
                                                </div>
                                                <div class="mr-4">
                                                    <input type="radio" name="getting_value" value="gu"
                                                        id="" class="mx-2">
                                                    <label class="font-weight-bold text-primary">Getting
                                                        Unpause</label>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12 d-flex flex-column ">
                                                    <label for="reason"
                                                        class="font-weight-bold text-primary">Reason</label>
                                                    <textarea name="reason" id="" required cols="60" rows="5" class="p-2"
                                                        placeholder="Enter Comments"></textarea>

                                                </div>
                                            </div>
                                            <input type="text" name="product_id" hidden
                                                value="{{ $products->id }}">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-12">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Update the Getting Pause & Unpause</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5">
                                <form action="{{ route('store.history.getting') }}" method="post">
                                    @csrf
                                    <div class="orm-group mb-10 d-flex flex-row">
                                        <div class="">
                                            <label for="">Getting Pause</label>
                                            <input type="radio" name="getting_value" value="gp"
                                                id="">
                                        </div>
                                        <div class="mr-4">
                                            <label for="">Getting Unpause</label>
                                            <input type="radio" name="getting_value" value="gu"
                                                id="">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12 d-flex flex-column ">
                                            <label for="reason">Reason</label>
                                            <textarea name="reason" id="" cols="60" rows="5" placeholder="Enter Comments"></textarea>

                                        </div>
                                    </div>
                                    <input type="text" name="product_id" hidden value="{{ $products->id }}">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

</x-app-layout>
