<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />

</head>

<body>
    <div id="myApp">
        <x-navBar></x-navBar>
        <x-message></x-message>
        @if(isset($data))
        <div>
            <button @click="resolve()" class="btn btn-secondary">resolve</button>
            <button @click="_delete()" class="btn btn-danger">delete</button>
        </div>
        <table class="mydatatable display" style="width:100%">
            <thead>
                <tr>
                    <th>select</th>
                    <th>date</th>
                    <th>ID</th>
                    <th>name</th>
                    <th>summary</th>
                    <th>type</th>
                    <th>status</th>
                    <th>severity</th>
                    <th>priority</th>

                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td @click="select()" class="text-center"><input type="checkbox" id="{{$item->id}}"></td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>
                        <a href="/ticket/{{$item->id}}">{{$item->summary}}</a>
                    </td>

                    <td>{{$item->getType()}}</td>
                    <td>{{$item->getStatus()}}</td>
                    <td>{{$item->getSeverity()}}</td>
                    <td>{{$item->getPriority()}}</td>


                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    @auth
    <script>
        const vueParam = {
            el: "#myApp",
            data() { //放自定義變數的地方
                return {
                    type: "",
                    token: "{{Auth::user()->getToken()}}",
                    resolveUrl: {
                        'bug': '/resolve/bug',
                        'test case': '/resolve/testCase',
                        'feature request': '/resolve/featureRequest',
                    },
                    deleteUrl: {
                        'bug': '/delete/bug',

                    },
                }
            },
            methods: { //定義function的地方
                select() {
                    let selectLn = $("input[type='checkbox']:checked").length;
                    if (selectLn == 1) {
                        this.type = $("input[type='checkbox']:checked").parent().parent().children().eq(5).text();
                    } else if (selectLn > 1) {
                        alert('限一筆項目');
                    }
                },
                _delete() {
                    let selectLn = $("input[type='checkbox']:checked").length;
                    if (selectLn < 1) {
                        alert('請選擇欲一筆項目!');
                        return;
                    } else if (selectLn > 1) {
                        alert('一次只能選擇一筆');
                        return;
                    }
                    let selectTicketId = $("input[type='checkbox']:checked").parent().parent().children().eq(2).text();
                    let url = this.deleteUrl[this.type];
                    console.log();
                    if (!(typeof url == 'undefined')) {
                        axios.post(url, {
                            token: this.token,
                            id: selectTicketId,
                        }).then(function(e) {
                            console.log(e.data);
                            if (e.data == 'success') {
                                alert('更新成功');
                                window.location.reload();
                            } else {
                                alert('無權限執行此動作!');
                            }
                        })
                    }else{
                        alert('尚未提供該項目刪除功能');
                    }

                },
                resolve() {
                    let selectLn = $("input[type='checkbox']:checked").length;
                    if (selectLn < 1) {
                        alert('請選擇欲一筆項目!');
                        return;
                    } else if (selectLn > 1) {
                        alert('一次只能選擇一筆');
                        return;
                    }
                    let selectTicketId = $("input[type='checkbox']:checked").parent().parent().children().eq(2).text();
                    let url = this.resolveUrl[this.type];
                    axios.post(url, {
                        token: this.token,
                        id: selectTicketId,
                    }).then(function(e) {
                        if (e.data == 'success') {
                            alert('更新成功');
                            window.location.reload();
                        } else {
                            alert('無權限執行此動作!');
                        }
                    })
                }
            },
            created() { // 生命周期-在一个实例被创建之后执行代码。 `this` 指向 vm 实例

            },
            mounted() { //vue實體與掛載完成
                $(".mydatatable").DataTable({
                    "order": [
                        [1, "desc"]
                    ]
                });
            },

        }
        const vm = new Vue(vueParam);
    </script>
    @endauth
</body>

</html>