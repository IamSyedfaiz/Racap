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
                        <h1 class="h3 mb-0 text-gray-800">Message</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Message Center</h1>
                                <div>
                                    <div class="form-group">
                                        <label for="search">Search</label>
                                        <input type="text" class="form-control" id="search" name="search">
                                    </div>
                                    <div class="">
                                        <button type="button" onclick="search()"
                                            class="btn btn-primary">Submit</button>
                                        <button type="button" onclick="refresh()"
                                            class="btn btn-primary">Refresh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row message-center" id="message-center">


                                {{-- <div class="col-12">
                                    <div class="float-right card text-white bg-gradient-primary mb-3"
                                        style="width: 60%;">
                                        <div class="card-header text-white bg-primary"> hy
                                            <small class="float-right text-white">hello</small>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">title</h5>
                                            <p class="card-text">messages</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="float-left card  text-white bg-gradient-success mb-3"
                                        style="width: 60%;">
                                        <div class="card-header text-white bg-primary"> hy
                                            <small class="float-right text-white">hello</small>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">title</h5>
                                            <p class="card-text">messages</p>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Send communication</h4>
                            <form action="{{ route('enquiry.send') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" required name="title"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
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

                <div class="container py-5 px-4">
                    <!-- Start -->
                    {{-- <header class="text-center">
                        <h1 class="display-4 text-white">Bootstrap Chat</h1>
                        <p class="text-white lead mb-0">chat widget with Bootstrap 4</p>
                        <p class="text-white lead mb-4">Snippet by
                            <a href="https://bootstrapious.com" class="text-white">
                                <u>Brusky</u></a>
                        </p>
                    </header> --}}

                    <div class="row rounded-lg overflow-hidden shadow">
                        <!-- Users box-->
                        <div class="col-5 px-0">
                            <div class="bg-white">

                                <div class="bg-gray px-4 py-2 bg-light">
                                    <p class="h5 mb-0 py-1">Recent</p>
                                </div>

                                <div class="messages-box">
                                    <div class="list-group rounded-0">
                                        @foreach ($users as $user)
                                            <a href="{{ route('chat.show', $user->id) }}"
                                                class="list-group-item list-group-item-action {{ $receiver->id == $user->id ? 'active' : '' }} mt-2 {{ $receiver->id == $user->id ? 'text-white' : '' }} rounded-0">
                                                <div class="media"><img
                                                        src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg"
                                                        alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">{{ $user->name }}</h6><small
                                                                class="small font-weight-bold">25 Dec</small>
                                                        </div>
                                                        <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit
                                                            amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt
                                                            ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Chat Box-->
                        <div class="col-7 px-0">
                            <div class="px-4 py-5 chat-box bg-white h-100">
                                <div class="bg-gray px-4 py-2 bg-light">
                                    <p class="h5 mb-0 py-1">{{ @$receiver->name }}</p>
                                </div>
                                <!-- Sender Message-->
                                <div class="media w-50 mb-3"><img
                                        src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg"
                                        alt="user" width="50" class="rounded-circle">
                                    <div class="media-body ml-3">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-muted">Test which is a new approach all
                                                solutions</p>
                                        </div>
                                        <p class="small text-muted">12:00 PM | Aug 13</p>
                                    </div>
                                </div>

                                <!-- Reciever Message-->
                                <div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white">Test which is a new approach to have
                                                all solutions</p>
                                        </div>
                                        <p class="small text-muted">12:00 PM | Aug 13</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Typing area -->
                            <form action="#" class="bg-light" style="position: relative">
                                <div class="input-group" style="position: absolute; bottom: 0; left: 0;">
                                    <input type="text" placeholder="Type a message" aria-describedby="button-addon2"
                                        class="form-control rounded-0 border-0 py-4 bg-light">
                                    <div class="input-group-append">
                                        <button id="button-addon2" type="submit" class="btn btn-link"> <i
                                                class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        var user_id = @json(auth()->user()->id);
        var chat_name = @json(auth()->user()->name);

        var isSearching = false;

        setInterval(() => {
            if (!isSearching) {
                $.ajax({
                    url: "{{ route('enquiry', ':id') }}".replace(':id', user_id),
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var messages = response;
                        var html = '';
                        $.each(messages, function(index, message) {

                            if (user_id == message.sender_id) {
                                const created_at = message
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
                                    message.sender.name +
                                    '<small class="float-right text-white">' +
                                    formatted_date +
                                    '</small>'
                                '</div>'
                                html += '<div class="card-body">'
                                html += '<h5 class="card-title">' + message.title + '</h5>'
                                html += '   <p class="card-text">' + message.messages +
                                    '</p>'
                                html += '</div>'
                                html += '</div>'
                                html += '</div>'
                                html += '</div>'
                            } else {

                                const created_at = message
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
                                    message.sender.name +
                                    '<small class="float-right text-white">' +
                                    formatted_date + '</small>'
                                '</div>'
                                html += '<div class="card-body">'
                                html += '<h5 classmonth="card-title">' + message.title +
                                    '</h5>'
                                html += '<p class="card-text">' + message.messages + '</p>'
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
            }
        }, 2000);

        // search
    </script>
    <script>
        function search() {

            // isSearching = true; // Set the flag to indicate search is in progress

            var searchText = $('#search').val();
            console.log(searchText);
            $.ajax({
                url: "{{ route('enquiry.search', ':id') }}".replace(':id', user_id),
                method: 'GET',
                dataType: 'json',
                data: {
                    searchText: searchText,
                },
                success: function(response) {
                    console.log(response);
                    var conversations = response;
                    var html = '';
                    $.each(conversations, function(index, conversation) {
                        if (user_id == conversation.sender_id) {
                            const created_at = conversation.created_at; // example timestamp string
                            const date = new Date(created_at);
                            const formatted_date = date.toLocaleTimeString('es-CL', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$1-$2');
                            html += '<div class="col-12">';
                            html +=
                                '<div class="float-right card text-white bg-gradient-primary mb-3" style="width: 60%;">';
                            html += '<div class="card-header text-white bg-primary">' + conversation
                                .sender.name + '<small class="float-right text-white">' +
                                formatted_date + '</small></div>';
                            html += '<div class="card-body">';
                            html += '<h5 class="card-title">' + conversation.title + '</h5>';
                            html += '<p class="card-text">' + conversation.messages + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        } else {
                            const created_at = conversation.created_at; // example timestamp string
                            const date = new Date(created_at);
                            const formatted_date = date.toLocaleTimeString('es-CL', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$1-$2');
                            html += '<div class="col-12">';
                            html +=
                                '<div class="float-left card  text-white bg-gradient-success mb-3" style="width: 60%;">';
                            html += '<div class="card-header text-white bg-success">' + conversation
                                .sender.name + '<small class="float-right text-white">' +
                                formatted_date + '</small></div>';
                            html += '<div class="card-body">';
                            html += '<h5 classmonth="card-title">' + conversation.title + '</h5>';
                            html += '<p class="card-text">' + conversation.messages + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        }
                    });
                    $('#message-center').html(html);

                    isSearching = true; // Reset the flag after search is completed
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    isSearching = true; // Reset the flag in case of an error
                }
            });
            isSearching = true; // Reset the flag after search is completed

        }
    </script>
    <script>
        function refresh() {
            isSearching = false; // Reset the flag after search is completed
        }
    </script>


</x-app-layout>
