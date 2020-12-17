<!DOCTYPE html>
<html>
    <head>
        <title> PostHub - @yield('title')</title>
        <link rel="favicon" sizes="16x16" href="{{ asset('/favicon.ico') }}">
    </head>
    <body>
        <h1> PostHub - @yield('title')</h1>
        @if (session('message'))
        
            <p><b> {{ session('message') }} </b></p> 
            
        @endif
        @if ($errors->any())
            <div>
                <p>Errors:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        
                        <li> {{ $error}}</li>

                    @endforeach

                </ul>
            </div>                
        @endif

        <div>
            @yield('content')
        </div>

    </body>
</html>