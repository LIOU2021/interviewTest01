<style>
    form {
        margin-left: 34px;
    }

    form div {
        margin-top: 15px;
    }

    label {
        position: relative;
    }

    label input,
    label select {
        position: absolute;
        left: 130px;
    }

    .dialog {
        position: absolute;
        z-index: 9;
        left: 394px;
        background-color: sandybrown;
        height: 314px;
        width: 500px;
    }
</style>

<div class="dialog" style="display:none">
    <div class="text-end">
        <button onclick="$('.dialog').hide()" class="">X</button>
    </div>

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
                <select name="type" id="">
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
                password confirm
                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}">
            </label>
        </div>

        <div>
            <label for="">
                email
                <input type="email" name="email" value="{{old('email')}}">
            </label>
        </div>

        <div class="text-center">
            <input type="submit">
        </div>

    </form>
</div>