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
                <h1 class="h3 mb-0 text-gray-800">Current Projects</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">All current projects</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Project id</th>
                                            <th>Client</th>
                                            <th>Product</th>
                                            <th>Last Communication</th>
                                            <th>Response Status</th>
                                            <th>Progress Status</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach (@$products as $product)
                                            @if ($product->project->project_start_date <= $currentDate && $product->project->project_end_date >= $currentDate)
                                                <tr>
                                                    <td>{{ $product->project->id }} </td>
                                                    <td>{{ $product->client->name }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>
                                                        @if (@$product->conversation->last()->sender->name)
                                                            @if (@$product->conversation->last()->user->getRoleNames()->first() == 'Sub Admin')
                                                                <img src="{{ asset('img/admin.jpg') }}"
                                                                    class="rounded mr-0" alt="...">
                                                            @elseif (@$product->conversation->last()->user->getRoleNames()->first() == 'Consultant')
                                                                <img src="{{ asset('img/client.jpg') }}"
                                                                    class="rounded mr-0" alt="...">
                                                            @elseif (@$product->conversation->last()->user->getRoleNames()->first() == 'Client')
                                                                <img src="{{ asset('img/vendor.jpg') }}"
                                                                    class="rounded mr-0" alt="...">
                                                            @endif
                                                        @endif

                                                        {{ @$product->conversation->last()->sender->name }}
                                                    </td>
                                                    <td>
                                                        {{-- {{ $product->response->id }} --}}
                                                        @foreach ($product->response as $response)
                                                            @if ($response->reply_under_process == 'Y')
                                                                <div class="btn "
                                                                    style="color:#fff; background:blue;"> R</div>
                                                            @endif

                                                            @if ($response->awaited_reply_under_process == 'Y')
                                                                <div class="btn"
                                                                    style="color:#fff; background:blue;">D</div>
                                                            @endif
                                                            @if ($response->docs_verification_under_process == 'Y')
                                                                <div class="btn"
                                                                    style="color:#fff; background:green;">P</div>
                                                            @endif
                                                            @if ($response->info_awaited == 'Y')
                                                                <div class="btn"
                                                                    style="color:#fff; background:green;">I</div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @php
                                                            $progressreports = \App\Models\ProgressReport::where('product_id', $product->id)->get();
                                                            $filteredPercentage = $progressreports->where('is_completed', 'N');
                                                            $filteredName = $progressreports->where('is_completed', 'N')->last();
                                                            $allLength = count($progressreports);
                                                            $length = count($filteredPercentage);
                                                            if ($allLength > 0) {
                                                                $calculatedPercentage = ($length / $allLength) * 100;
                                                                $calculatedPercentage = intval($calculatedPercentage);
                                                            } else {
                                                                $calculatedPercentage = 0;
                                                                $calculatedPercentage = intval($calculatedPercentage);
                                                            }
                                                            $latestEntry = \App\Models\HistoryGetting::where('product_id', $product->id)
                                                                ->orderBy('created_at', 'desc')
                                                                ->first();
                                                        @endphp

                                                        {{-- Display the product information here --}}
                                                        {{-- <p>Product Name: {{ $product->name }}</p>
                                                    <p>Calculated Percentage: {{ $calculatedPercentage }}</p>
                                                    <p>Latest Entry: {{ $latestEntry->created_at }}</p> --}}
                                                        @if (@$latestEntry->getting_value == 'gp')
                                                            <p class="text-danger">Getting Pause</p>
                                                        @elseif (@$latestEntry->getting_value == 'gu')
                                                            <p class="text-success">Getting Unpause</p>
                                                        @endif
                                                        <h4 class="small font-weight-bold">
                                                            {{ @$filteredName->phase_name }}
                                                            <span
                                                                class="float-right">{{ @$calculatedPercentage }}%</span>
                                                        </h4>
                                                        <div class="progress mb-4">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: {{ @$calculatedPercentage }}%"
                                                                aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>


                                                    <td>{{ date('d-m-Y', strtotime($product->project->project_start_date)) }}
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($product->project->project_end_date)) }}
                                                    </td>
                                                    <td><a href="{{ route('project.details', ['id' => $product->id]) }}"
                                                            class="btn btn-primary btn-sm">View</a>
                                                    </td>
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

            <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

</x-app-layout>
