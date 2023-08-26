<x-app-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
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
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
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
            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Management</h1>
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Client (Step 1)</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('add_client') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cname">Client name</label>
                                            <input type="text" class="form-control" required name="client_name"
                                                id="cname" aria-describedby="cname">
                                            @error('client_name')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Client Category </label>
                                            <select class="form-control" id="cname" name="client_category" required>
                                                <option value="">Select An Option</option>
                                                <option value="D">Domestic </option>
                                                <option value="F">Foreign</option>
                                            </select>
                                            @error('client_category')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Factory Name (Step 2)</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('add.factory') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cname">Factory name</label>
                                            <input type="text" class="form-control" required name="factory_name"
                                                id="cname" aria-describedby="cname">
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Client Category </label>
                                            <select class="form-control" id="client_category" name="client_category"
                                                required>
                                                <option value="">Select An Option</option>
                                                <option value="D">Domestic </option>
                                                <option value="F">Foreign</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select client</label>
                                            <select class="form-control" id="client_id" name="client_id" required>
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('client_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Project (Step 3)</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('add_project') }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label for="cname">Project name</label>
                                            <input type="text" class="form-control" required name="project_name"
                                                id="cname" aria-describedby="cname">
                                            @error('project_name')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="sdate">Project start date</label>
                                            <input type="date" class="form-control" name="project_start_date"
                                                required id="sdate" aria-describedby="sdate">
                                        </div>
                                        <div class="form-group">
                                            <label for="edate">Project end date</label>
                                            <input type="date" class="form-control" name="project_end_date" required
                                                id="edate" aria-describedby="edate">
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Client Category </label>
                                            <select class="form-control" id="project_client_category" required
                                                name="client_category">
                                                <option value="">Select An Option</option>
                                                <option value="D">Domestic </option>
                                                <option value="F">Foreign</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select client</label>
                                            <select class="form-control" id="project_cname" name="client_id"
                                                required>
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('client_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Factory</label>
                                            <select class="form-control" id="factory_cname" name="factory_id"
                                                required>
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('factory_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div><!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Product (Step 4)</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('add_product') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cname">Brand name</label>
                                            <input type="text" class="form-control" required name="brand_name"
                                                id="cname" aria-describedby="cname">
                                            @error('brand_name')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Product name</label>
                                            <input type="text" class="form-control" required name="product_name"
                                                id="cname" aria-describedby="cname">
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Model Number</label>
                                            <input type="text" class="form-control" required name="modal_number"
                                                id="cname" aria-describedby="cname">
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Client Category</label>
                                            <select class="form-control" id="product_client_category" required
                                                name="client_category">
                                                <option value="">Select An Option</option>
                                                <option value="D">Domestic </option>
                                                <option value="F">Foreign</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select client</label>
                                            <select class="form-control" id="product_cname" name="client_id"
                                                required>
                                                <option>Select An Option</option>
                                            </select>
                                            @error('client_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select Factory</label>
                                            <select class="form-control" id="product_factory_cname" required
                                                name="factory_id">
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('factory_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Select project</label>
                                            <select class="form-control" id="product_pname" name="project_id"
                                                required>
                                                <option value="">Select An Option</option>
                                            </select>
                                            @error('project_id')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- Earnings (Monthly) Card Example -->

                        @if ($roles === 'Client' || $roles === 'Sub Admin' || $roles === 'Super Admin')


                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Add (Client) User to project
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('add_client_project') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cname">Select User</label>
                                                <select class="form-control" id="client_user_cname" name="user_id"
                                                    required>
                                                    <option value="">Select An Option</option>
                                                    @foreach (@$users as $user)
                                                        @if ($user->getRoleNames()->first() == 'Client')
                                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Select Client Category </label>
                                                <select class="form-control" id="add_client_category" required
                                                    name="client_category">
                                                    <option value="">Select An Option</option>
                                                    <option value="D">Domestic </option>
                                                    <option value="F">Foreign</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Select Client</label>
                                                <select class="form-control" id="client_cname" name="client_id"
                                                    required>
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('client_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Select Factory</label>
                                                <select class="form-control" id="client_factory_cname" required
                                                    name="factory_id">
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('factory_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Project Name</label>
                                                <select class="form-control" id="client_project_name" required
                                                    name="project_id">
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('project_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Brand Name</label>
                                                <select class="form-control" id="client_brand_name" name="brand_id"
                                                    required>
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('brand_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Product Name</label>
                                                <select class="form-control" id="client_product_name" required
                                                    name="product_id">
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('product_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Model Number</label>
                                                <select class="form-control" id="client_modal_number" required
                                                    name="modal_number">
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('modal_number')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endif

                        @if ($roles === 'Consultant' || $roles === 'Sub Admin' || $roles === 'Super Admin')

                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Add (Consultant) User to product
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('add_consultant_project') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cname">Select User</label>
                                                <select class="form-control" id="consultant_user_cname" required
                                                    name="user_id">
                                                    <option value="">Select An Option</option>
                                                    @foreach (@$users as $user)
                                                        @if ($user->getRoleNames()->first() == 'Consultant')
                                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Select Client Category </label>
                                                <select class="form-control" id="add_consultant_category" required
                                                    name="client_category">
                                                    <option value="">Select An Option</option>
                                                    <option value="D">Domestic </option>
                                                    <option value="F">Foreign</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Select Client</label>
                                                <select class="form-control" id="consultant_cname" name="client_id"
                                                    required>
                                                    <option value="">Select An Option</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Select Factory</label>
                                                <select class="form-control" id="consultant_factory_cname" required
                                                    name="factory_id">
                                                    <option value="">Select An Option</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('factory_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Project name</label>
                                                <select class="form-control" id="consultant_project_name" required
                                                    name="project_id">
                                                    <option value="">Select An Option</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Brand Name</label>
                                                <select class="form-control" id="consultant_brand_name" required
                                                    name="brand_id">
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('brand_id')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Product name</label>
                                                <select class="form-control" id="consultant_product_name" required
                                                    name="product_id">
                                                    <option>Select An Option</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Model Number</label>
                                                <select class="form-control" id="consultant_modal_number" required
                                                    name="modal_number">
                                                    <option value="">Select An Option</option>
                                                </select>
                                                @error('modal_number')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        @endif




                        <!-- Earnings (Monthly) Card Example -->

                        <!-- Earnings (Monthly) Card Example -->

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">View Teams</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">


                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">All Teams</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="createTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Client</th>
                                                    <th>Project</th>
                                                    <th>Product</th>
                                                    <th>Factory</th>
                                                    <th>Brand</th>
                                                    <th hidden>Email</th>
                                                    <th>Client team</th>
                                                    <th>Consultant team</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ @$product->client->name }}</td>

                                                        <td>{{ @$product->project->project_name }}</td>

                                                        <td>{{ @$product->product_name }}</td>
                                                        <td>{{ @$product->factory->name }}</td>
                                                        <td>{{ @$product->brand_name }}</td>
                                                        <td hidden>{{ @$product->user->email }}</td>
                                                        <td>
                                                            @foreach ($product->productdetail as $detail)
                                                                @if (@$detail->type == 'CL')
                                                                    <a class=""
                                                                        onclick="document.getElementById('myModalOD{{ $detail->user->id }}').showModal()"
                                                                        id="btn"
                                                                        style="border-radius: 5px; color:black; font-weight: bold; cursor: pointer;">
                                                                        {{ @$detail->user->name }}
                                                                    </a>,
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($product->productdetail as $detail)
                                                                @if ($detail->type == 'CO')
                                                                    <a class=""
                                                                        onclick="document.getElementById('myModalOD{{ $detail->user->id }}').showModal()"
                                                                        id="btn"
                                                                        style="border-radius: 5px; color:black; font-weight: bold; cursor: pointer;">
                                                                        {{ @$detail->user->name }}
                                                                    </a>,
                                                                @endif
                                                                <dialog id="myModalOD{{ $detail->user->id }}">
                                                                    <div class="flex flex-col w-full h-auto ">
                                                                        <div
                                                                            class="flex w-full h-auto mb-20 px-4 rounded text-center ">
                                                                            Remove {{ $detail->user->name }} from
                                                                            Project
                                                                        </div>
                                                                        <div class=" d-flex justify-content-end mt-4 ">
                                                                            <button
                                                                                onclick="document.getElementById('myModalOD{{ $detail->user->id }}').close()"
                                                                                class="mr-2 px-2 py-1 rounded-lg "
                                                                                data-modal-toggle="default-modal">Cancel</button>
                                                                            <a
                                                                                href="{{ route('remove.project', ['id' => $detail->user->id]) }}">
                                                                                <button
                                                                                    onclick="document.getElementById('myModalOD').close();"
                                                                                    class=" px-2 py-1 rounded-lg   hover:bg-opacity-50">OK</button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </dialog>
                                                            @endforeach
                                                        </td>
                                                    </tr>
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
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RACAP 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="userRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Project?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Remove User To Project .</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Remove</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this entry?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger btn-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#createTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    filename: 'AllTeams',
                    text: 'Download',
                    // exportOptions: {
                    //     columns: ':visible' // Export all visible columns
                    // }
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7] // Include all columns for export
                    }
                }]
            });
        });
    </script>
    <script>
        // Add Product
        $projects = @json($projects);
        $products = @json($products);
        $factories = @json($factories);
        $clients = @json($clients);
        $('#client_category').change(function(e) {
            $oldVal = {{ old('client_id', 0) }};

            $('#client_id').html(``);
            $('#client_id').append(` <option value=""> Select an option </option>`);
            $.each($clients, function(index, $client) {
                if ($client.category == $('#client_category').val()) {
                    if ($oldVal) {
                        $('#client_id').append(`<option` +
                            $oldVal == $client.id ? "selected" : "" +
                            `value="` + $client.id + `">` + $client.name + `</option>`);
                    } else {
                        $('#client_id').append(
                            `<option value="` + $client.id + `">` + $client.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#project_client_category').change(function(e) {
            $oldVal = {{ old('project_cname', 0) }};

            $('#project_cname').html(``);
            $('#project_cname').append(` <option value=""> Select an option </option>`);
            $.each($clients, function(index, $client) {
                if ($client.category == $('#project_client_category').val()) {
                    if ($oldVal) {
                        $('#project_cname').append(`<option` +
                            $oldVal == $client.id ? "selected" : "" +
                            `value="` + $client.id + `">` + $client.name + `</option>`);
                    } else {
                        $('#project_cname').append(
                            `<option value="` + $client.id + `">` + $client.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#project_cname').change(function(e) {
            $oldVal = {{ old('factory_cname', 0) }};

            $('#factory_cname').html(``);
            $('#factory_cname').append(` <option> Select an option </option>`);
            $.each($factories, function(index, $factory) {
                if ($factory.client_id == $('#project_cname').val()) {
                    if ($oldVal) {
                        $('#factory_cname').append(`<option` +
                            $oldVal == $factory.id ? "selected" : "" +
                            `value="` + $factory.id + `">` + $factory.name + `</option>`);
                    } else {
                        $('#factory_cname').append(
                            `<option value="` + $factory.id + `">` + $factory.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#product_client_category').change(function(e) {
            $oldVal = {{ old('product_cname', 0) }};

            $('#product_cname').html(``);
            $('#product_cname').append(` <option value=""> Select an option </option>`);
            $.each($clients, function(index, $client) {
                if ($client.category == $('#product_client_category').val()) {
                    if ($oldVal) {
                        $('#product_cname').append(`<option` +
                            $oldVal == $client.id ? "selected" : "" +
                            `value="` + $client.id + `">` + $client.name + `</option>`);
                    } else {
                        $('#product_cname').append(
                            `<option value="` + $client.id + `">` + $client.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#product_cname').change(function(e) {
            $oldVal = {{ old('product_factory_cname', 0) }};

            $('#product_factory_cname').html(``);
            $('#product_factory_cname').append(` <option> Select an option </option>`);
            $.each($factories, function(index, $factory) {
                if ($factory.client_id == $('#product_cname').val()) {
                    if ($oldVal) {
                        $('#product_factory_cname').append(`<option` +
                            $oldVal == $factory.id ? "selected" : "" +
                            `value="` + $factory.id + `">` + $factory.name + `</option>`);
                    } else {
                        $('#product_factory_cname').append(
                            `<option value="` + $factory.id + `">` + $factory.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#product_factory_cname').change(function(e) {
            $oldVal = {{ old('product_pname', 0) }};

            $('#product_pname').html(``);
            $('#product_pname').append(` <option> Select an option </option>`);
            $.each($projects, function(index, $project) {
                if ($project.factory_id == $('#product_factory_cname').val()) {
                    if ($oldVal) {
                        $('#product_pname').append(`<option` +
                            $oldVal == $project.id ? "selected" : "" +
                            `value="` + $project.id + `">` + $project.project_name + `</option>`);
                    } else {
                        $('#product_pname').append(
                            `<option value="` + $project.id + `">` + $project.project_name + `</option>`
                        );
                    }
                }
            });
        });

        // Add (Client) User to project
        $('#add_client_category').change(function(e) {
            $oldVal = {{ old('client_cname', 0) }};

            $('#client_cname').html(``);
            $('#client_cname').append(` <option value=""> Select an option </option>`);
            $.each($clients, function(index, $client) {
                if ($client.category == $('#add_client_category').val()) {
                    if ($oldVal) {
                        $('#client_cname').append(`<option` +
                            $oldVal == $client.id ? "selected" : "" +
                            `value="` + $client.id + `">` + $client.name + `</option>`);
                    } else {
                        $('#client_cname').append(
                            `<option value="` + $client.id + `">` + $client.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#client_cname').change(function(e) {
            $oldVal = {{ old('client_factory_cname', 0) }};
            $('#client_factory_cname').html(``);
            $('#client_factory_cname').append(` <option> Select an option </option>`);
            $.each($factories, function(index, $factory) {
                if ($factory.client_id == $('#client_cname').val()) {
                    if ($oldVal) {
                        $('#client_factory_cname').append(`<option` +
                            $oldVal == $factory.id ? "selected" : "" +
                            `value="` + $factory.id + `">` + $factory.name + `</option>`);
                    } else {
                        $('#client_factory_cname').append(
                            `<option value="` + $factory.id + `">` + $factory.name +
                            `</option>`
                        );
                    }
                }
            });
        });
        $('#client_factory_cname').change(function(e) {
            $oldVal = {{ old('client_project_name', 0) }};

            $('#client_project_name').html(``);
            $('#client_project_name').append(` <option> Select an option </option>`);
            $.each($projects, function(index, $project) {
                if ($project.factory_id == $('#client_factory_cname').val()) {
                    if ($oldVal) {
                        $('#client_project_name').append(`<option` +
                            $oldVal == $project.id ? "selected" : "" +
                            `value="` + $project.id + `">` + $project.project_name + `</option>`);
                    } else {
                        $('#client_project_name').append(
                            `<option value="` + $project.id + `">` + $project.project_name + `</option>`
                        );
                    }
                }
            });
        });
        $('#client_project_name').change(function(e) {
            $oldVal = {{ old('client_brand_name', 0) }};
            $('#client_brand_name').html(``);
            $('#client_brand_name').append(` <option> Select an option </option>`);
            $.each($products, function(index, $product) {
                // console.log($product.project_id, 'pid');
                if ($product.project_id == $('#client_project_name').val()) {
                    if ($oldVal) {
                        $('#client_brand_name').append(`<option` +
                            $oldVal == $product.id ? "selected" : "" +
                            `value="` + $product.id + `">` + $product.brand_name + `</option>`);
                    } else {
                        $('#client_brand_name').append(
                            `<option value="` + $product.id + `">` + $product.brand_name +
                            `</option>`
                        );
                    }
                }
            });
        });
        $('#client_brand_name').change(function(e) {
            $oldVal = {{ old('client_product_name', 0) }};
            $('#client_product_name').html(``);
            $('#client_product_name').append(` <option> Select an option </option>`);
            $.each($products, function(index, $product) {
                if ($product.id == $('#client_brand_name').val()) {
                    if ($oldVal) {
                        $('#client_product_name').append(`<option` +
                            $oldVal == $product.id ? "selected" : "" +
                            `value="` + $product.id + `">` + $product.product_name + `</option>`);
                    } else {
                        $('#client_product_name').append(
                            `<option value="` + $product.id + `">` + $product.product_name +
                            `</option>`
                        );
                    }
                }
            });
        });
        $('#client_product_name').change(function(e) {
            $oldVal = {{ old('client_modal_number', 0) }};
            $('#client_modal_number').html(``);
            $('#client_modal_number').append(` <option> Select an option </option>`);
            $.each($products, function(index, $product) {
                if ($product.id == $('#client_product_name').val()) {
                    if ($oldVal) {
                        $('#client_modal_number').append(`<option` +
                            $oldVal == $product.id ? "selected" : "" +
                            `value="` + $product.id + `">` + $product.modal_number + `</option>`);
                    } else {
                        $('#client_modal_number').append(
                            `<option value="` + $product.id + `">` + $product.modal_number +
                            `</option>`
                        );
                    }
                }
            });
        });
        // Add (Client) User to project

        // Add (Consultant) User to product
        $('#add_consultant_category').change(function(e) {
            $oldVal = {{ old('consultant_cname', 0) }};

            $('#consultant_cname').html(``);
            $('#consultant_cname').append(` <option value=""> Select an option </option>`);
            $.each($clients, function(index, $client) {
                if ($client.category == $('#add_consultant_category').val()) {
                    if ($oldVal) {
                        $('#consultant_cname').append(`<option` +
                            $oldVal == $client.id ? "selected" : "" +
                            `value="` + $client.id + `">` + $client.name + `</option>`);
                    } else {
                        $('#consultant_cname').append(
                            `<option value="` + $client.id + `">` + $client.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#consultant_cname').change(function(e) {
            $oldVal = {{ old('consultant_factory_cname', 0) }};

            $('#consultant_factory_cname').html(``);
            $('#consultant_factory_cname').append(` <option> Select an option </option>`);
            $.each($factories, function(index, $factory) {
                if ($factory.client_id == $('#consultant_cname').val()) {
                    if ($oldVal) {
                        $('#consultant_factory_cname').append(`<option` +
                            $oldVal == $factory.id ? "selected" : "" +
                            `value="` + $factory.id + `">` + $factory.name + `</option>`);
                    } else {
                        $('#consultant_factory_cname').append(
                            `<option value="` + $factory.id + `">` + $factory.name + `</option>`
                        );
                    }
                }
            });
        });
        $('#consultant_factory_cname').change(function(e) {
            $oldVal = {{ old('consultant_project_name', 0) }};

            $('#consultant_project_name').html(``);
            $('#consultant_project_name').append(` <option> Select an option </option>`);
            $.each($projects, function(index, $project) {
                if ($project.factory_id == $('#consultant_factory_cname').val()) {
                    if ($oldVal) {
                        $('#consultant_project_name').append(`<option` +
                            $oldVal == $project.id ? "selected" : "" +
                            `value="` + $project.id + `">` + $project.project_name + `</option>`);
                    } else {
                        $('#consultant_project_name').append(
                            `<option value="` + $project.id + `">` + $project.project_name + `</option>`
                        );
                    }
                }
            });
        });
        $('#consultant_project_name').change(function(e) {
            $oldVal = {{ old('consultant_brand_name', 0) }};

            $('#consultant_brand_name').html(``);
            $('#consultant_brand_name').append(` <option> Select an option </option>`);
            $.each($products, function(index, $product) {
                if ($product.project_id == $('#consultant_project_name').val()) {
                    if ($oldVal) {
                        $('#consultant_brand_name').append(`<option` +
                            $oldVal == $product.id ? "selected" : "" +
                            `value="` + $product.id + `">` + $product.brand_name + `</option>`);
                    } else {
                        $('#consultant_brand_name').append(
                            `<option value="` + $product.id + `">` + $product.brand_name + `</option>`
                        );
                    }
                }
            });
        });
        $('#consultant_brand_name').change(function(e) {
            $oldVal = {{ old('consultant_product_name', 0) }};
            $('#consultant_product_name').html(``);
            $('#consultant_product_name').append(` <option> Select an option </option>`);
            $.each($products, function(index, $product) {
                if ($product.id == $('#consultant_brand_name').val()) {
                    if ($oldVal) {
                        $('#consultant_product_name').append(`<option` +
                            $oldVal == $product.id ? "selected" : "" +
                            `value="` + $product.id + `">` + $product.product_name + `</option>`);
                    } else {
                        $('#consultant_product_name').append(
                            `<option value="` + $product.id + `">` + $product.product_name +
                            `</option>`
                        );
                    }
                }
            });
        });
        $('#consultant_product_name').change(function(e) {
            $oldVal = {{ old('consultant_modal_number', 0) }};
            $('#consultant_modal_number').html(``);
            $('#consultant_modal_number').append(` <option> Select an option </option>`);
            $.each($products, function(index, $product) {
                if ($product.id == $('#consultant_product_name').val()) {
                    if ($oldVal) {
                        $('#consultant_modal_number').append(`<option` +
                            $oldVal == $product.id ? "selected" : "" +
                            `value="` + $product.id + `">` + $product.modal_number + `</option>`);
                    } else {
                        $('#consultant_modal_number').append(
                            `<option value="` + $product.id + `">` + $product.modal_number + `</option>`
                        );
                    }
                }
            });
        });
        // Add (Consultant) User to product
    </script>
</x-app-layout>
