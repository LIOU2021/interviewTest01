@if(Auth::check())
<div class="text-end">
    <p style="display:inline-block;">{{Auth::user()->name}}</p>
    <a href="/" class="btn btn-primary">首頁</a>
    <button onclick="alert('{{Auth::user()->getToken()}}');" style="display:inline-block;">提示token</button>

    <div class="dropdown" style="display:inline-block;">
        
        @if(Auth::user()->type=='4')
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->getUserType()}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{route('admin.user')}}">成員管理</a></li>
            <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li> -->
        </ul>
        @else
        <button class="btn btn-secondary" type="button">
            {{Auth::user()->getUserType()}}
        </button>
        @endif
    </div>

    <a href="{{route('logout')}}" class="btn btn-danger" style="display:inline-block;">登出</a>
</div>
@else
<div class="text-end">
    <a href="{{route('login')}}" class="btn btn-success">登入</a>
</div>
@endif