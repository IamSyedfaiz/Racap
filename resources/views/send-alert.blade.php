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
                <h1 class="h3 mb-0 text-gray-800">Alert History</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Alert History</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Project Name</th>
                                            {{-- <th>Folder Name</th> --}}
                                            <th>Alert Date & Time</th>
                                            <th>Message</th>
                                            <th>Mode</th>
                                            {{-- <th>Date & Time</th> --}}
                                            <th>Done By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (@$SendAlerts as $index => $SendAlert)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $SendAlert->product->project->project_name }}</td>
                                                <td>{{ $SendAlert->created_at }}</td>
                                                <td>{{ $SendAlert->message }}</td>
                                                <td>{{ $SendAlert->mode }}</td>
                                                <td>
                                                    @if (@$SendAlert->user->getRoleNames()->first() == 'Sub Admin')
                                                        <img src="../img/admin.jpg" class="rounded mr-0" alt="...">
                                                    @elseif (@$SendAlert->user->getRoleNames()->first() == 'Consultant')
                                                        <img src="../img/client.jpg" class="rounded mr-0"
                                                            alt="...">
                                                    @elseif (@$SendAlert->user->getRoleNames()->first() == 'Client')
                                                        <img src="../img/vendor.jpg" class="rounded mr-0"
                                                            alt="...">
                                                    @endif
                                                    {{ $SendAlert->user->name }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-body p-4">
                            <div class="mb-5">
                                <form action="{{ route('save.send.alert') }}" method="POST">
                                    @csrf
                                    <div class="">
                                        <div class="form-group col-md-12 d-flex ">
                                            <div class="col-md-12 d-flex flex-column ">
                                                <label for="reason"
                                                    class="font-weight-bold text-primary">Message</label>
                                                <textarea name="message"></textarea>
                                                @error('message')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex flex-column ">
                                            <div class="form-group col-md-6 d-flex flex-column ">
                                                <div for="reason" class="font-weight-bold text-primary">Mode</div>
                                                <select class="form-control" name="mode">
                                                    <option value="">Select a Mode</option>
                                                    <option value="Email">Email</option>
                                                </select>
                                                @error('mode')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                                <input type="text" name="product_id" value="{{ $product->id }}"
                                                    hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
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

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    filename: 'CurrentData',
                    text: 'Download',
                    exportOptions: {
                        columns: ':visible' // Export all visible columns
                    }
                }]
            });
        });
    </script>

</x-app-layout>
