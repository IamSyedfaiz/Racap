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
                                <li>Project : {{ $products->project->project_name }}</li>
                                <li>Product : {{ $products->product_name }}</li>
                                <li>No of Application : 001</li>
                                <li>Brand :{{ $products->client->name }}</li>
                                <li>Model :{{ $products->modal_number }}</li>
                                <li>Start Date: {{ $products->project->project_start_date }}</li>
                                <li>Standard Due Date: 31-12-2020</li>
                                <li>Expected Finishing Date: {{ $products->project->project_end_date }}</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h2>Client Name</h2>
                    <h4 class="small font-weight-bold">Test Reports <span class="float-right">70%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70"
                            aria-valuemin="0" aria-valuemax="100"></div>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Message Center</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="row message-center" id="message-center">



                        {{-- @foreach ($conversations as $conversation)
                            @if (auth()->user()->id === $conversation->sender_id)
                                <div class="col-12">
                                    <div class="float-right card text-white bg-gradient-primary mb-3"
                                        style="width: 60%;">
                                        <div class="card-header text-white bg-primary">{{ $conversation->user->name }}
                                            <small
                                                class="float-right text-white">{{ $conversation->created_at }}</small>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $conversation->title }}</h5>
                                            <p class="card-text">{{ $conversation->messages }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="float-left card  text-white bg-gradient-success mb-3"
                                        style="width: 60%;">
                                        <div class="card-header text-white bg-success">
                                            {{ $conversation->user->name }}<small
                                                class="float-right text-white">{{ $conversation->created_at }}</small>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $conversation->title }}</h5>
                                            <p class="card-text">{{ $conversation->messages }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach --}}
                    </div>

                </div>


                <div class="col-md-4">
                    <h4>Send communication</h4>

                    <form action="{{ route('message.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" required name="title" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <input type="text" hidden value="{{ $products->id }}" name="product_id">
                            <input type="text" hidden value="0" name="client_id">

                            <input type="text" hidden value="{{ $products->user_id }}" name="user_id">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Message</label>

                            <textarea type="text" class="form-control textarea" required name="messages"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>








        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        var product_id = @json($products->id);
        var user_id = @json(auth()->user()->id);
        var chat_name = @json(auth()->user()->name);

        setInterval(() => {
            $.ajax({
                // url: '/conversation/' + product_id,   
                url: "{{ route('conversation', ':id') }}".replace(':id', product_id),
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var conversations = response;
                    var html = '';
                    $.each(conversations, function(index, conversation) {
                 
                        if (user_id == conversation.sender_id) {
                            
                            
                            const created_at = conversation
                                .created_at; // example timestamp string
                            const date = new Date(created_at);
                            const formatted_date = date.toLocaleTimeString('es-CL', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$1-$2');
                            html += '<div class="col-12">';
                            html +=
                                '<div class="float-right card text-white bg-gradient-primary mb-3" style="width: 60%;">'
                            html += '<div class="card-header text-white bg-primary">' +
                                conversation.sender.name +
                                '<small class="float-right text-white">' +
                                formatted_date +
                                '</small>'
                            '</div>'
                            html += '<div class="card-body">'
                            html += '<h5 class="card-title">' + conversation.title + '</h5>'
                            html += '   <p class="card-text">' + conversation.messages + '</p>'
                            html += '</div>'
                            html += '</div>'
                            html += '</div>'
                            html += '</div>'
                        } else {

                            const created_at = conversation
                                .created_at; // example timestamp string
                            const date = new Date(created_at);
                            const formatted_date = date.toLocaleTimeString('es-CL', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$1-$2');
                            html += '<div class="col-12">';
                            html +=
                                '<div class="float-left card  text-white bg-gradient-success mb-3" style="width: 60%;">'
                            html += '<div class="card-header text-white bg-success">' +
                                conversation.sender.name +
                                '<small class="float-right text-white">' +
                                formatted_date + '</small>'
                            '</div>'
                            html += '<div class="card-body">'
                            html += '<h5 classmonth="card-title">' + conversation.title +
                                '</h5>'
                            html += '<p class="card-text">' + conversation.messages + '</p>'
                            html += '</div>'
                            html += '</div>'
                            html += '</div>'
                            html += '</div>'
                        }
                    });
                    $('#message-center').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
        }, 2000);
    </script>

</x-app-layout>
