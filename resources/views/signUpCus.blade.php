<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊Customer token</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="text-center">
        <h1>取得group token</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('signUpCus')}}" method="POST">
            @csrf
            <label for="">
                name
                <input type="text" name="name" value="{{old('name')}}">
            </label>
            <div>
                <input type="submit">
            </div>

        </form>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>