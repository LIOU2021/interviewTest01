<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script>
        let msg ='{{session("msg")}}';
        if(msg){
            alert(msg);
        }
    </script>
</head>

<body>
    <div class="text-center">
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

            <input type="submit">
            <div>
                <a href="{{route('signUp')}}">還沒成為會員?</a>
            </div>
            <div>
                <a href="{{route('signUpCus')}}">還沒customer name?</a>
            </div>
        </form>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>