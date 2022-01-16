<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <x-navBar></x-navBar>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 mt-5">
                <div>
                    <p>id:{{$data->id}}</p>
                    <p>date:{{$data->created_at}}</p>
                    <p>type:{{$data->getType()}}</p>
                    <p>status:{{$data->getStatus()}}</p>
                    <p>severity:{{$data->getSeverity()}}</p>
                    <p>priority:{{$data->getPriority()}}</p>
                    <p>summary:{{$data->summary}}</p>
                    <p>description:{{$data->description}}</p>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>