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
        left: 83px;
    }

    #description {
        position: absolute;
        left: 117px;
        height: 100px;
        width: 292px;
    }

    .descriptionDiv {
        height: 100px;
    }

    .dialog {
        position: absolute;
        z-index: 9;
        left: 317px;
        top: 100px;
        background-color: sandybrown;
        height: 433px;
        width: 500px;
    }
</style>

<div class="dialog" style="display: none;">
    <div class="text-end">
        <button onclick="$('.dialog').hide()" class="">X</button>
    </div>
    <h1 class="text-center" id='dialogTitle'>create</h1>
    <form action="/create/bug" method="POST" id="createForm">
        @csrf
        <div id="idDiv">
            <label for="">
                id
                <input type="text" name="id" value="" hidden>
            </label>
        </div>

        <div class="d-none">
            <label for="">
                user_id
                <input type="text" name="user_id" value="{{Auth::user()->id}}">
            </label>
        </div>

        <div class="">
            <label for="">
                summary
                <input type="text" name="summary" value="{{old('summary')}}">
            </label>
        </div>

        <div class="descriptionDiv">
            <label for="description">
                description
            </label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>

        </div>

        <div class="d-none">
            <label for="">
                status
                <input type="text" name="status" value="1">
            </label>
        </div>

        <div>
            <label for="">
                type
                <select name="type" id="typeSelect">
                    <option value="1">bug</option>
                    <option value="2">feature request</option>
                    <option value="3">test case</option>
                </select>
            </label>
        </div>
        <div>
            <label for="">
                severity
                <select name="severity" id="">
                    <option value="1">一般</option>
                    <option value="2">嚴重</option>
                    <option value="3">極為嚴重</option>
                </select>
            </label>
        </div>
        <div>
            <label for="">
                priority
                <select name="priority" id="">
                    <option value="1">普通</option>
                    <option value="2">次要</option>
                    <option value="3">優先</option>
                </select>
            </label>
        </div>

        <div class="d-none">
            <label for="">
                token
                <input type="text" name="token" value="{{Auth::user()->getToken()}}">
            </label>
        </div>

        <div class="d-none">
            <label for="">
                group_id
                <input type="text" name="group_id" value="{{Auth::user()->group_id}}">
            </label>
        </div>

        <div class="text-center">
            <input type="submit">
        </div>

    </form>
</div>