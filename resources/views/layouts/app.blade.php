<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PostHub</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand mb-0 h1" href="{{ url('/') }}" style="color:#0065bd">PostHub</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-4"><a class="nav-link {{ request()->is('categories/Animals') ? 'active' : '' }}" href="{{ route('categories.show', ['category' => 'Animals' ]) }}"> Animals </a></li>
                        <li class="nav-item px-4"><a class="nav-link {{ request()->is('categories/Funny') ? 'active' : '' }}" href="{{ route('categories.show', ['category' => 'Funny' ]) }}"> Funny </a></li>
                        <li class="nav-item px-4"><a class="nav-link {{ request()->is('categories/Gaming') ? 'active' : '' }}" href="{{ route('categories.show', ['category' => 'Gaming' ]) }}"> Gaming </a></li>
                        <li class="nav-item px-4"><a class="nav-link {{ request()->is('categories/AskAnything') ? 'active' : '' }}" href="{{ route('categories.show', ['category' => 'AskAnything' ]) }}"> AskAnything </a></li>
                        <li class="nav-item px-4"><a class="nav-link {{ request()->is('categories/Misc') ? 'active' : '' }}" href="{{ route('categories.show', ['category' => 'Misc' ]) }}"> Misc </a></li>
                        <li class="nav-item px-4"><a class="nav-link {{ request()->is('posts/nasa') ? 'active' : '' }}" href="{{ route('nasa.show')}}"> APOD </a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="navbar-brand" href="{{route('profiles.show', ['profile' => Auth::user()->profile])}}"> {{ Auth::user()->profile->username }} </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (session('message'))
            <div class="container">
                <div class="d-flex justify-content-center" id="messages-div">
                    <div class="alert alert-success" role="alert" id="messages">
                        <strong>{{ session('message') }}</strong>
                    </div>
                </div>
            </div>
            
            
            
            @endif
            @yield('content')
        </main>
    </div>
    <script>
        var pusher = new Pusher('fb6aad9492c3703869d6', {
            encrypted: true,
            cluster: 'eu',
            forceTLS: true
        });

        var channel = pusher.subscribe('user.{{Auth::id()}}');

        channel.bind('App\\Events\\CommentAdded', function(data) {
            if(data.commentUser.user_id != data.poster.user_id){
                console.log(data);

                if (!("Notification" in window)) {
                    alert("Your browser doesn't support notifications");
                }

                else if (Notification.permission === "granted") {
                    var notification = new Notification(data.message, {
                        body: "Click here to view the post", 
                        icon: "{{ asset('favicon.ico') }}",
                    });
                    notification.onclick = () => {
                        window.open(window.location.href="/categories/" + data.category + "/" + data.post);
                    };
                }

                else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function (permission) {
                        if (permission === "granted") {
                            var notification = new Notification(data.message, {
                                body: "Click here to view the post", 
                                icon: "{{ asset('favicon.ico') }}",
                            });
                            notification.onclick = () => {
                                window.open(window.location.href);
                            };
                        }
                    });
                }                
            }
        });
    </script>
</body>
</html>
