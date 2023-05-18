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
                <h1 class="h3 mb-0 text-gray-800">Past Projects</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">All Past projects</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Project id</th>
                                            <th>Client</th>
                                            <th>Product</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            @if ($product->project->project_end_date < $currentDate)
                                                <tr>
                                                    <td>{{ $product->project->id }} </td>
                                                    <td>{{ $product->client->name }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->project->project_start_date }}</td>
                                                    <td>{{ $product->project->project_end_date }}</td>
                                                    <td><a href="{{ route('past.edit', ['id' => $product->project->id]) }}"
                                                            class="btn btn-primary btn-sm">Edit</a> </td>
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


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

</x-app-layout>
