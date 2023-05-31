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
        <style>
            .switch {
                /* switch */
                --switch-width: 46px;
                --switch-height: 24px;
                --switch-bg: rgb(131, 131, 131);
                --switch-checked-bg: rgb(0, 218, 80);
                --switch-offset: calc((var(--switch-height) - var(--circle-diameter)) / 2);
                --switch-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
                /* circle */
                --circle-diameter: 18px;
                --circle-bg: #fff;
                --circle-shadow: 1px 1px 2px rgba(146, 146, 146, 0.45);
                --circle-checked-shadow: -1px 1px 2px rgba(163, 163, 163, 0.45);
                --circle-transition: var(--switch-transition);
                /* icon */
                --icon-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
                --icon-cross-color: var(--switch-bg);
                --icon-cross-size: 6px;
                --icon-checkmark-color: var(--switch-checked-bg);
                --icon-checkmark-size: 10px;
                /* effect line */
                --effect-width: calc(var(--circle-diameter) / 2);
                --effect-height: calc(var(--effect-width) / 2 - 1px);
                --effect-bg: var(--circle-bg);
                --effect-border-radius: 1px;
                --effect-transition: all .2s ease-in-out;
            }

            .switch input {
                display: none;
            }

            .switch {
                display: inline-block;
                margin-left: 25px;
            }

            .switch svg {
                -webkit-transition: var(--icon-transition);
                -o-transition: var(--icon-transition);
                transition: var(--icon-transition);
                position: absolute;
                height: auto;
            }

            .switch .checkmark {
                width: var(--icon-checkmark-size);
                color: var(--icon-checkmark-color);
                -webkit-transform: scale(0);
                -ms-transform: scale(0);
                transform: scale(0);
            }

            .switch .cross {
                width: var(--icon-cross-size);
                color: var(--icon-cross-color);
            }

            .slider {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                width: var(--switch-width);
                height: var(--switch-height);
                background: var(--switch-bg);
                border-radius: 999px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                position: relative;
                -webkit-transition: var(--switch-transition);
                -o-transition: var(--switch-transition);
                transition: var(--switch-transition);
                cursor: pointer;
            }

            .circle {
                width: var(--circle-diameter);
                height: var(--circle-diameter);
                background: var(--circle-bg);
                border-radius: inherit;
                -webkit-box-shadow: var(--circle-shadow);
                box-shadow: var(--circle-shadow);
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                -webkit-transition: var(--circle-transition);
                -o-transition: var(--circle-transition);
                transition: var(--circle-transition);
                z-index: 1;
                position: absolute;
                left: var(--switch-offset);
            }

            .slider::before {
                content: "";
                position: absolute;
                width: var(--effect-width);
                height: var(--effect-height);
                left: calc(var(--switch-offset) + (var(--effect-width) / 2));
                background: var(--effect-bg);
                border-radius: var(--effect-border-radius);
                -webkit-transition: var(--effect-transition);
                -o-transition: var(--effect-transition);
                transition: var(--effect-transition);
            }

            /* actions */

            .switch input:checked+.slider {
                background: var(--switch-checked-bg);
            }

            .switch input:checked+.slider .checkmark {
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
            }

            .switch input:checked+.slider .cross {
                -webkit-transform: scale(0);
                -ms-transform: scale(0);
                transform: scale(0);
            }

            .switch input:checked+.slider::before {
                left: calc(100% - var(--effect-width) - (var(--effect-width) / 2) - var(--switch-offset));
            }

            .switch input:checked+.slider .circle {
                left: calc(100% - var(--circle-diameter) - var(--switch-offset));
                -webkit-box-shadow: var(--circle-checked-shadow);
                box-shadow: var(--circle-checked-shadow);
            }
        </style>
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
                {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
                {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ @$products->modal_number }}</h6>
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
                                {{-- <li>Expected Finishing Date: {{ @$products->project->project_end_date }}</li> --}}
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
                                <h6 class="m-0 font-weight-bold text-primary">Add Phase Name</h6>
                            </div>
                            <div class="card-body" id="inputFields">
                            </div>
                        </div>

                    </div><!-- Earnings (Monthly) Card Example -->


                </div>
            </form>
            <div class="">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Phase Updates</h6>
                        <a href="{{ route('delete.status', ['id' => $products->id]) }}" class="btn btn-primary">Reset
                            All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Phase Name</th>
                                        @if ($roles === 'Consultant' || $roles === 'Sub Admin')
                                            <th>Status</th>
                                        @endif

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
                                                @if ($roles === 'Consultant' || $roles === 'Sub Admin')
                                                    <td>
                                                        @if ($progressreport->is_completed == 'Y')
                                                            <a href="{{ route('change.status', ['id' => $progressreport->id]) }}"
                                                                class="btn btn-success text-white mr-2">Done</a>
                                                        @endif

                                                    </td>
                                                @endif
                                                @if ($progressreport->is_completed == 'Y')
                                                    <td>
                                                        <button class="btn btn-danger">
                                                            <svg fill="#fff" width="30px" viewBox="0 0 200 200"
                                                                data-name="Layer 1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165Z">
                                                                </path>
                                                                <path
                                                                    d="M128.5,74a9.67,9.67,0,0,0-14,0L100,88.5l-14-14a9.9,9.9,0,0,0-14,14l14,14-14,14a9.9,9.9,0,0,0,14,14l14-14,14,14a9.9,9.9,0,0,0,14-14l-14-14,14-14A10.77,10.77,0,0,0,128.5,74Z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                    <td>-</td>
                                                @endif

                                                @if ($progressreport->is_completed == 'N')
                                                    <td>-</td>

                                                    <td><button class="btn btn-success"><svg viewBox="0 0 24 24"
                                                                fill="none" width="30px"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4"
                                                                    d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z"
                                                                    fill="#fff"></path>
                                                                <path
                                                                    d="M10.5795 15.5801C10.3795 15.5801 10.1895 15.5001 10.0495 15.3601L7.21945 12.5301C6.92945 12.2401 6.92945 11.7601 7.21945 11.4701C7.50945 11.1801 7.98945 11.1801 8.27945 11.4701L10.5795 13.7701L15.7195 8.6301C16.0095 8.3401 16.4895 8.3401 16.7795 8.6301C17.0695 8.9201 17.0695 9.4001 16.7795 9.6901L11.1095 15.3601C10.9695 15.5001 10.7795 15.5801 10.5795 15.5801Z"
                                                                    fill="#fff"></path>

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

            @if ($roles === 'Consultant')
                <form action="{{ route('response.status') }}" method="post">
                    @csrf
                    <div class="row ">

                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Response Status</h6>
                                </div>
                                <div class="d-flex ">
                                    <div class="card-body col-6">
                                        <div class="form-group d-flex">
                                            <input type="text" value="{{ $products->id }}" name="product_id"
                                                hidden>
                                            <label for="exampleFormControlSelect1">Reply Under Process</label>
                                            <label class="switch">
                                                <input type="checkbox" value="Y" name="processyes"
                                                    {{ @$response->reply_under_process === 'Y' ? 'checked' : '' }}>
                                                <div class="slider">
                                                    <div class="circle">
                                                        <svg class="cross" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 365.696 365.696" y="0"
                                                            x="0" height="6" width="6"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path data-original="#000000" fill="currentColor"
                                                                    d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg class="checkmark" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 24 24" y="0" x="0"
                                                            height="10" width="10"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path class="" data-original="#000000"
                                                                    fill="currentColor"
                                                                    d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body col-6">
                                        <div class="form-group d-flex">
                                            <label for="exampleFormControlSelect1">
                                                Payment Awaited</label>
                                            <label class="switch">
                                                <input type="checkbox" value="Y" name="awaited"
                                                    {{ @$response->awaited_reply_under_process === 'Y' ? 'checked' : '' }}>
                                                <div class="slider">
                                                    <div class="circle">
                                                        <svg class="cross" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 365.696 365.696" y="0"
                                                            x="0" height="6" width="6"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path data-original="#000000" fill="currentColor"
                                                                    d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg class="checkmark" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 24 24" y="0" x="0"
                                                            height="10" width="10"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path class="" data-original="#000000"
                                                                    fill="currentColor"
                                                                    d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex ">
                                    <div class="card-body col-6">
                                        <div class="form-group d-flex">
                                            <label for="exampleFormControlSelect1">Docs verification Under
                                                Process</label>
                                            <label class="switch">
                                                <input type="checkbox" value="Y" name="docsverification"
                                                    {{ @$response->docs_verification_under_process === 'Y' ? 'checked' : '' }}>
                                                <div class="slider">
                                                    <div class="circle">
                                                        <svg class="cross" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 365.696 365.696" y="0"
                                                            x="0" height="6" width="6"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path data-original="#000000" fill="currentColor"
                                                                    d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg class="checkmark" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 24 24" y="0" x="0"
                                                            height="10" width="10"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path class="" data-original="#000000"
                                                                    fill="currentColor"
                                                                    d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body col-6">
                                        <div class="form-group d-flex">
                                            <label for="exampleFormControlSelect1">Info Awaited</label>
                                            <label class="switch">
                                                <input type="checkbox" value="Y" name="infoawaited"
                                                    {{ @$response->info_awaited === 'Y' ? 'checked' : '' }}>
                                                <div class="slider">
                                                    <div class="circle">
                                                        <svg class="cross" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 365.696 365.696" y="0"
                                                            x="0" height="6" width="6"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path data-original="#000000" fill="currentColor"
                                                                    d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg class="checkmark" xml:space="preserve"
                                                            style="enable-background:new 0 0 512 512"
                                                            viewBox="0 0 24 24" y="0" x="0"
                                                            height="10" width="10"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path class="" data-original="#000000"
                                                                    fill="currentColor"
                                                                    d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="product_id" value="{{ $products->id }}" hidden>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div><!-- Earnings (Monthly) Card Example -->
                    </div>
                </form>
            @endif

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
