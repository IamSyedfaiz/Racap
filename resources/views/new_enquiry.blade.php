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

                                <div class="messages-box" style="overflow-y: auto; height: 80vh;">
                                    <div class="list-group rounded-0">
                                        @foreach ($users as $user)
                                            @php
                                                $lastMessage = $user->getLastMessage();
                                            @endphp

                                            <a href="{{ route('chat.show', $user->id) }}"
                                                class="list-group-item list-group-item-action {{ @$receiver->id == $user->id ? 'active' : '' }} mt-2 {{ @$receiver->id == $user->id ? 'text-white' : '' }} rounded-0">
                                                <div class="media"><img
                                                        src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg"
                                                        alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                                            {{-- <small class="small font-weight-bold">
                                                                {{ $lastMessage ? $lastMessage->created_at->format('d M') : '' }}
                                                            </small> --}}
                                                        </div>
                                                        <p class="font-italic mb-0 text-small">
                                                            {{ $lastMessage ? $lastMessage->messages : '' }}
                                                        </p>
                                                    </div>
                                                    @if (Auth::check())
                                                        @if ($user->is_online === 'Y')
                                                        <h6 >Online</h6>
                                                            {{-- <svg class="ml-2" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" fill="#32de84"
                                                                class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                                <circle cx="8" cy="8" r="8" />
                                                            </svg> --}}
                                                        @else
                                                            <p>
                                                                {{ $user->updated_at->diffForHumans() }}</p>
                                                        @endif
                                                    @endif
                                                    @if (@$lastMessage->is_seen == 'N' && $roles == 'Sub Admin')
                                                        <div class="ml-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                                <circle cx="8" cy="8" r="8" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Chat Box-->
                        <div class="col-7 px-0">
                            <div class="bg-gray px-4 py-2 bg-light d-flex justify-content-between">
                                <p class="h5 mb-0 py-1">{{ @$receiver->name }}</p>
                                <button class="btn btn-primary" onclick="refreshPage()">Refresh</button>
                            </div>

                            <div class="px-4 py-5 chat-box bg-white" style="overflow-y: auto; height: 80vh; ">
                                @if (@$messages)

                                    @foreach (@$messages as $message)
                                        @if (@$message->receiver_id == auth()->user()->id)
                                            <!-- Sender Message -->
                                            <div class="media w-50 mb-3"><img
                                                    src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg"
                                                    alt="user" width="50" class="rounded-circle">
                                                <div class="media-body ml-3">
                                                    <div class="bg-light rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-muted">Title
                                                            : {{ @$message->title }}
                                                        </p>
                                                        <p class="text-small mb-0 text-muted">Message
                                                            : {{ @$message->messages }}
                                                        </p>
                                                    </div>
                                                    <p class="small text-muted">
                                                        {{ @$message->created_at->format('h:i A | M d') }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Receiver Message -->
                                            <div class="media w-50 ml-auto mb-3">
                                                <div class="media-body">
                                                    <div class="bg-primary rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-white">Title
                                                            : {{ @$message->title }}
                                                        </p>
                                                        <p class="text-small mb-0 text-white">Message
                                                            : {{ @$message->messages }}
                                                        </p>
                                                    </div>
                                                    <p class="small text-muted">
                                                        {{ $message->created_at->format('h:i A | M d') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                            <!-- Typing area -->
                            <form action="{{ route('enquiry.send') }}" method="POST" class="bg-light"
                                style="position: relative; margin-top: 200px;">
                                @csrf

                                <div class="input-group" style="position: absolute; bottom: 0; left: 0;">
                                    {{-- <input type="text" placeholder="Type a message" aria-describedby="button-addon2"
                                        class="form-control rounded-0 border-0 py-4 bg-light"> --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" required name="title"
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                            <input type="hidden" name="receiver_id" value="{{ @$receiver->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Message</label>
                                            <textarea type="text" class="form-control textarea" required name="messages"></textarea>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <button id="button-addon2" type="submit" class="btn btn-primary w-100"> <i
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

    <script>
        function refreshPage() {
            location.reload();
        }
    </script>
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        var user_id = @json(auth()->user()->id);
        var chat_name = @json(auth()->user()->name);
        var receiver_id = @json(@$receiver->id);


        setInterval(() => {
            $.ajax({
                url: "{{ route('enquiry', ':id') }}".replace(':id', user_id),
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var messages = response;
                    console.log(messages, 'sdhjfm');
                    var html = '';
                    $.each(messages, function(index, message) {
                        if (message.sender_id == user_id && message.receiver_id ==
                            receiver_id) {
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
                                'hello' +
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
                        } else if (message.sender_id == user_id && message.receiver_id ==
                            receiver_id) {

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
                                'message.sender.name' +
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
        }, 2000);

        // search
    </script> --}}
</x-app-layout>