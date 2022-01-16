<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員管理</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />

    <style>
        input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }
    </style>

</head>

<body>
    <x-navBar></x-navBar>
    <h1>會員管理</h1>

    <x-message></x-message>

    <div id="datatable">
        <div>
            <button @click="allow()" class="btn btn-success">允許審核申請</button>
            <button class="btn btn-danger">刪除</button>
        </div>

        <table class="mydatatable display" style="width:100%">
            <thead>
                <tr>
                    <th>select</th>
                    <th>ID</th>
                    <th>name</th>
                    <th>email</th>
                    <th>type</th>
                    <th>verify</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="text-center"><input type="checkbox" id="{{$item->id}}"></td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->getUserType()}}</td>
                    <td>{{$item->verify ?? "尚未驗證"}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script>
        const vueParam = {
            el: "#datatable",
            data() { //放自定義變數的地方
                return {
                    token: "{{Auth::user()->getToken()}}",
                }
            },
            methods: { //定義function的地方
                allow() {
                    let selectLn = $("input[type='checkbox']:checked").length;
                    if (selectLn < 1) {
                        alert('請選擇欲給予權限的user!');
                    } else if (selectLn > 1) {
                        alert('一次只能選擇一筆');
                    } else {
                        let selectUserId = $("input[type='checkbox']:checked").parent().parent().children().eq(1).text();
                        axios.post('/admin/verify', {
                            token: this.token,
                            id: selectUserId,
                        }).then(function(e){
                            if(e.data == 'success'){
                                alert('更新成功');
                                window.location.reload();
                            }else{
                                alert('更新失敗');
                            }
                        })
                    }
                },
            },
            created() { // 生命周期-在一个实例被创建之后执行代码。 `this` 指向 vm 实例
                $(".mydatatable").DataTable();
            },

        }
        const vm = new Vue(vueParam);
    </script>
</body>

</html>