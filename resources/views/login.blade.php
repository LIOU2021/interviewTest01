<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <style>
        label {
            position: relative;
        }

        label input {
            position: absolute;
            left: 50px;
        }

        form div {
            margin-top: 15px;
        }
    </style>
    <script>
        let msg = '{{session("msg")}}';
        if (msg) {
            alert(msg);
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h1>登入</h1>
                @if (!is_null(session('token')))
                <div class="alert alert-success">
                    <ul>
                        <li>{{session('token')}}</li>
                    </ul>
                </div>
                @endif
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div>
                        <label for="">
                            email
                            <input type="email" name="email">
                        </label>
                    </div>

                    <div>
                        <label for="">
                            password
                            <input type="password" name="password">
                        </label>
                    </div>

                    <div>
                        <input type="submit">
                    </div>

                    <div>
                        <a href="{{route('signUp')}}">還沒成為會員?</a>
                    </div>
                    <div>
                        <a href="{{route('signUpCus')}}">還沒token?</a>
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>