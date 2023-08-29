<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('custom.css') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    File Upload
                    <!-- <div id="hello-react"></div> -->
                    <!-- <div id="counter"></div> -->
                </div>
                    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
                <form action="{{url('view')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="links">
                        <input type="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-sm mr-2">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>
