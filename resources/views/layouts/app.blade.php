<!DOCTYPE html>
<html>
    <head>
        <title> PostHub - @yield('title')</title>
        <link rel="favicon" sizes="16x16" href="{{ asset('/favicon.ico') }}">
    </head>
    <body>
        <h1> PostHub - @yield('title')</h1>
        <div>
            @yield('content')
        </div>
    </body>
</html>