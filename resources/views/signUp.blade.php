<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="text-center">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('signUp')}}" method="POST">
            @csrf


            <div>
                <label for="">
                    name
                    <input type="text" name="name" value="{{old('name')}}">
                </label>
            </div>

            <div>
                <label for="">
                    type
                    <select name="type" id="" value="{{old('type')}}">
                        <option value="1">QA</option>
                        <option value="2">RD</option>
                        <option value="3">PM</option>
                        <option value="4">Administrator</option>
                    </select>
                </label>
            </div>

            <div>
                <label for="">
                    token
                    <input type="text" name="token">
                </label>
            </div>

            <div>
                <label for="">
                    password
                    <input type="password" name="password" value="{{old('password')}}">
                </label>
            </div>

            <div>
                <label for="">
                    email
                    <input type="email" name="email" value="{{old('email')}}">
                </label>
            </div>

            <div>
                <input type="submit">
            </div>

        </form>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>