<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <div id="app">
        @if(Auth::check())
            <div class="text-end">
                <button onclick="alert('{{Auth::user()->getToken()}}');" style="display:inline-block;">提示token</button>
                <p style="display:inline-block;">{{Auth::user()->getUserType()}}</p>
                <a href="{{route('logout')}}" class="btn btn-danger" style="display:inline-block;">登出</a>
            </div>
        @else
            <div class="text-end">
                <a href="{{route('login')}}" class="btn btn-success">登入</a>
            </div>
        @endif
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>