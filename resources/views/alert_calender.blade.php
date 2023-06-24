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
                <h1 class="h3 mb-0 text-gray-800">Alert Calender</h1>
                <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $products->modal_number }}</h6>
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
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Content Row -->
            <div class="row">
                <div class="col-12">


                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-infobank" role="tabpanel"
                            aria-labelledby="pills-infobank-tab">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Alert Calender List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Project ID</th>
                                                    <th>Particular</th>
                                                    <th>Renew/Due Date</th>
                                                    <th>Alert Note</th>
                                                    <th>Alert Date</th>
                                                    <th>Uploaded By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php $i = 1; ?>
                                            @foreach ($calender_alerts as $calender_alert)
                                                <tr>

                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ @$calender_alert->product->modal_number }}</td>
                                                    <td>{{ $calender_alert->particular }}</td>
                                                    <td>{{ $calender_alert->renew_date }}</td>
                                                    <td>{{ $calender_alert->alert_note }}</td>
                                                    {{-- @if ($current_date == @$alert_date1)
                                                        <td>{{ $calender_alert->alert_date1 }}</td>
                                                    @elseif ($current_date == @$alert_date2)
                                                        <td>{{ $calender_alert->alert_date2 }}</td>
                                                    @else
                                                        <td>{{ $calender_alert->alert_date3 }}</td>
                                                    @endif --}}
                                                    <td>
                                                        <span
                                                            class="d-block">{{ $calender_alert->alert_date1 }},</span>
                                                        <span
                                                            class="d-block">{{ $calender_alert->alert_date2 }},</span>
                                                        <span class="d-block">{{ $calender_alert->alert_date3 }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($calender_alert->user->getRoleNames()->first() == 'Sub Admin')
                                                            <img src="../img/admin.jpg" class="rounded mr-0"
                                                                alt="...">
                                                        @elseif ($calender_alert->user->getRoleNames()->first() == 'Consultant')
                                                            <img src="../img/client.jpg" class="rounded mr-0"
                                                                alt="...">
                                                        @elseif ($calender_alert->user->getRoleNames()->first() == 'Client')
                                                            <img src="../img/vendor.jpg" class="rounded mr-0"
                                                                alt="...">
                                                        @endif{{ $calender_alert->user->name }}
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('delete.alert.calender', ['id' => $calender_alert->id]) }}">
                                                            <button class="bg-black" type="button"
                                                                style="background-color: black; border-radius: 5px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="text-white " viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                </svg>
                                                            </button>
                                                        </a>

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
                                {{-- <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Update the Getting Pause & Unpause
                                    </h6>
                                </div> --}}
                                <div class="card-body p-4">
                                    <div class="mb-5">
                                        <form action="{{ route('store.alert.calender') }}" method="post">
                                            @csrf
                                            <div class="">
                                                <div class="form-group col-md-12 d-flex ">
                                                    <div class="col-md-6 d-flex flex-column ">
                                                        <label for="reason"
                                                            class="font-weight-bold text-primary">Particular</label>
                                                        <input type="text" name="particular">
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <button class="btn border border-primary">Send
                                                            Alert</button>
                                                        <button class="btn border border-danger">Alert History</button>
                                                    </div> --}}


                                                </div>
                                                <div class="form-group col-md-6 d-flex flex-column ">
                                                    <label for="reason" class="font-weight-bold text-primary">Renew
                                                        Date</label>
                                                    <input type="date" name="renew_date">

                                                </div>
                                                <div class="form-group col-md-6 d-flex flex-column ">
                                                    <label for="reason" class="font-weight-bold text-primary">Alert
                                                        Date</label>
                                                    <input type="date" name="alert_date1">
                                                    <input class="my-2" type="date" name="alert_date2">
                                                    <input type="date" name="alert_date3">

                                                </div>
                                                <div class="form-group col-md-6 d-flex flex-column ">
                                                    <label for="reason" class="font-weight-bold text-primary">Alert
                                                        Note</label>
                                                    <input type="text" name="alert_note">

                                                </div>
                                                <input type="text" name="product_id" hidden
                                                    value="{{ $products->id }}">
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

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->


</x-app-layout>
