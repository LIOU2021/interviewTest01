@if (!is_null(session('msg')))
<div class="alert alert-success">
    <ul>
        <li>{{session('msg')}}</li>
    </ul>
</div>
@endif

@if (!is_null(session('token')))
<div class="alert alert-success">
    <ul>
        <li>{{session('token')}}</li>
    </ul>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif