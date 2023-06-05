<x-app-layout>

    <!-- Page Wrapper -->
    {{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> --}}
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
                <h1 class="h3 mb-0 text-gray-800">Project Report</h1>
                <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>

            <!-- Content Row -->




            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('filter.project') }}" method="GET">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="cname">Select Client Category </label>
                                <select class="form-control" id="client_category" name="client_category">
                                    <option value="">All</option>
                                    <option value="D">Domestic </option>
                                    <option value="F">Foreign</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput">Client</label>
                                <select class="form-control" id="client_name" name="client_id">
                                    <option value="">All</option>
                                    @foreach ($clients as $client)
                                        {{ $client }}
                                        <option value="{{ $client->id }}">{{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="formGroupExampleInput">Project</label>
                                <select class="form-control" id="project_name" name="project_id">
                                    <option value="">All</option>
                                    @foreach ($projects as $project)
                                        {{ $project }}
                                        <option value="{{ $project->id }}">{{ $project->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="formGroupExampleInput">Payment Status</label>
                                <select class="form-control" name="finance">
                                    <option value="">All</option>
                                    <option value="B">Balance Due</option>
                                    <option value="F">Fully Paid</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput">Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput">End Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-4">
                                <label for="formGroupExampleInput">Project Status</label>
                                <select class="form-control" name="project_status">
                                    <option value="">All</option>
                                    <option value="R">
                                        <div class="btn " style="color:#fff; background:blue;"> R</div>
                                    </option>
                                    <option value="D">
                                        <div class="btn" style="color:#fff; background:blue;">D</div>
                                    </option>
                                    <option value="P">
                                        <div class="btn" style="color:#fff; background:green;">P</div>
                                    </option>
                                    <option value="I">
                                        <div class="btn" style="color:#fff; background:green;">I</div>
                                    </option>

                                </select>
                            </div>
                            <div class="col-4">
                                <label for="formGroupExampleInput">History Getting</label>
                                <select class="form-control" name="history_getting">
                                    <option value="">All</option>
                                    <option value="gp">Pause</option>
                                    <option value="gu">Unpause</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">All</option>
                                    <option value="25">Less Than 25 %</option>
                                    <option value="50">Less Than 50 %</option>
                                    <option value="75">Less Than 75 %</option>
                                    <option value="100">Less Than 100 %</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" class="btn btn-secondary">Search</button>
                                {{-- <button type="button" class="btn btn-secondary">Download</button> --}}
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-12">


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ledger</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="reportTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Product Name</th>
                                            <th>Model Number</th>
                                            <th>Complete %</th>
                                            <th>Balance Due</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Response Status</th>
                                            <th>Client (Team) Name</th>
                                            <th>Consultant (Team) Name</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (@$products)
                                            @foreach (@$products as $product)
                                                @php
                                                    $sum = @$product->project_report->where('is_completed', 'N')->count();
                                                    $count = count(@$product->project_report);
                                                    $percent = $count > 0 ? intval(($sum / $count) * 100) : 0;
                                                    $availableBalance = @$product->account->last()->available_balance;
                                                    $finance = request()->get('finance') == 'B' ? $availableBalance > 0 : (request()->get('finance') == 'F' ? $availableBalance <= 0 : true);
                                                    $available = $availableBalance ? $finance : true;
                                                    $availablePercent = request()->get('status') ? $percent <= request()->get('status') : true;
                                                    
                                                    // echo $percent == request()->get('status');
                                                    
                                                @endphp
                                                @if ($available && $availablePercent)
                                                    <tr>
                                                        <td>{{ @$product->project->project_name }}</td>

                                                        <td>{{ @$product->product_name }}</td>

                                                        <td>{{ @$product->modal_number }}</td>
                                                        {{-- <td>
                                                            @php
                                                                $sum = @$product->project_report->where('is_completed', 'N')->count();
                                                                $count = count(@$product->project_report);
                                                            @endphp
                                                            @if ($sum)
                                                                {{ intval(($sum / $count) * 100) }} %
                                                            @else
                                                                0 %
                                                            @endif
                                                        </td> --}}
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
                                                                <div class="progress-bar bg-success"
                                                                    role="progressbar"
                                                                    style="width: {{ @$calculatedPercentage }}%"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            {{ @$product->account->last()->available_balance }}
                                                        </td>
                                                        <td>{{ @$product->project->project_start_date }}</td>
                                                        <td>{{ @$product->project->project_end_date }}</td>
                                                        <td>
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
                                                            @foreach (@$product->productdetail as $detail)
                                                                @if (@$detail->type == 'CL')
                                                                    {{ @$detail->user->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach (@$product->productdetail as $detail)
                                                                @if ($detail->type == 'CO')
                                                                    {{ $detail->user->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>


                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        {{-- <tr>
                                            <td>12133</td>
                                            <td>12133</td>
                                            <td>12133</td>
                                            <td>12133</td>
                                            <td>12133</td>
                                            <td>12133</td>
                                            <td>12133</td>
                                            <td>12133</td>
                                        </tr> --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>







                </div>
            </div>






        </div>
        <!-- /.container-fluid -->
        {{-- $(document).ready(function() {
            $('#reportTable').DataTable({
                dom: 'Bfrtip',
                // buttons: [
                //     'csv', 'excel', 'pdf'
                // ]
                buttons: [{
                    extend: 'csv',
                    filename: 'Report', // Specify the desired filename here
                    text: 'Download',
                    // exportOptions: {
                    //     columns: [0, 1, 2, 3] // Specify the columns to export
                    // }
                }]
            })
        }); --}}
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script> --}}
        <script>
            $(document).ready(function() {
                var table = $('#reportTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'csv',
                        filename: 'report',
                        text: 'Download',
                        exportOptions: {
                            columns: ':visible' // Export all visible columns
                        }
                    }]
                });
            });
        </script>
        <script>
            $projects = @json($projects);
            $clients = @json($clients);
            $('#client_category').change(function(e) {
                $oldVal = {{ old('client_name', 0) }};

                $('#client_name').html(``);
                $('#client_name').append(` <option value=""> Select an option </option>`);
                $.each($clients, function(index, $client) {
                    if ($client.category == $('#client_category').val()) {
                        if ($oldVal) {
                            $('#client_name').append(`<option` +
                                $oldVal == $client.id ? "selected" : "" +
                                `value="` + $client.id + `">` + $client.name + `</option>`);
                        } else {
                            $('#client_name').append(
                                `<option value="` + $client.id + `">` + $client.name + `</option>`
                            );
                        }
                    }
                });
            });
            $('#client_name').change(function(e) {
                $oldVal = {{ old('project_name', 0) }};

                $('#project_name').html(``);
                $('#project_name').append(` <option value=""> Select an option </option>`);
                $.each($projects, function(index, $project) {
                    if ($project.client_id == $('#client_name').val()) {
                        if ($oldVal) {
                            $('#project_name').append(`<option` +
                                $oldVal == $project.id ? "selected" : "" +
                                `value="` + $project.id + `">` + $project.project_name + `</option>`);
                        } else {
                            $('#project_name').append(
                                `<option value="` + $project.id + `">` + $project.project_name + `</option>`
                            );
                        }
                    }
                });
            });
        </script>
    </div>
    <!-- End of Page Wrapper -->


</x-app-layout>
