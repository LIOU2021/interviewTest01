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
    @auth
    <x-ticketDialog></x-ticketDialog>
    @endauth
    <div id="myApp">
        <x-navBar></x-navBar>
        <h1>首頁</h1>
        <x-message></x-message>
        @if(isset($data))
        <div>
            <button @click="resolve()" class="btn btn-secondary">resolve</button>
            <button @click="_delete()" class="btn btn-danger">delete</button>
            <button @click="toggleDialog('create')" class="btn btn-success">create</button>
            <button @click="toggleDialog('update')" class="btn btn-primary">edit</button>
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
                    <th style="display: none;">description</th>

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
                    <td style="display: none;">{{$item->description}}</td>


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
                    dialogSatus: "",
                    type: "",
                    token: "{{Auth::user()->getToken()}}",
                    resolveUrl: {
                        'bug': '/resolve/bug',
                        'test case': '/resolve/testCase',
                        'feature request': '/resolve/featureRequest',
                    },
                    deleteUrl: {
                        'bug': '/delete/bug',
                        // 'test case': '/delete/testCase',
                        // 'feature request': '/delete/featureRequest',
                    },
                    createUrl: {
                        '1': '/create/bug',
                        '2': '/create/featureRequest',
                        '3': '/create/testCase',
                    },
                    editUrl: {
                        '1': '/update/bug',
                        // '2': '/update/featureRequest',
                        // '3': '/update/testCase',
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
                        alert('請選擇一筆項目!');
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
                    } else {
                        alert('尚未提供該項目刪除功能');
                    }

                },
                resolve() {
                    let selectLn = $("input[type='checkbox']:checked").length;
                    if (selectLn < 1) {
                        alert('請選擇一筆項目!');
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
                },
                toggleDialog(t) {
                    $('#dialogTitle').text(t);
                    this.dialogSatus = t;
                    if ($(".dialog").is(":hidden")) {
                        if (t == 'create') {
                            $("input[name='id']").prop('hidden', true);
                            $("#idDiv").hide();
                            $("#createForm").attr('action', '/create/bug');

                            $("#createForm input[name='id']").val("");
                            $("#createForm input[name='summary']").val("");
                            $("#createForm textarea[name='description']").val("");
                            $("#createForm select[name='type']").val("1");
                            $("#createForm select[name='severity']").val("1");
                            $("#createForm select[name='priority']").val("1");
                            $("input[name='user_id']").prop('hidden', false);
                            $("input[name='status']").prop('hidden', false);
                            $("input[name='group_id']").prop('hidden', false);

                        } else if (t == 'update') {
                            let selectLn = $("input[type='checkbox']:checked").length;
                            if (selectLn < 1) {
                                alert('請選擇一筆項目!');
                                return;
                            } else if (selectLn > 1) {
                                alert('一次只能選擇一筆');
                                return;
                            }
                            let select = $("input[type='checkbox']:checked").parent().parent().children();
                            $("#createForm input[name='id']").val(select.eq(2).text());
                            $("#createForm input[name='summary']").val(select.eq(4).text());
                            $("#createForm textarea[name='description']").val(select.eq(9).text());
                            const typeNumber = {
                                'bug': "1",
                                'feature request': "2",
                                'test case': "3",
                            };
                            const severityNumber = {
                                '一般': "1",
                                '嚴重': "2",
                                '極為嚴重': "3",
                            };
                            const priorityNumber = {
                                '普通': "1",
                                '次要': "2",
                                '優先': "3",
                            };
                            $("#createForm select[name='type']").val(typeNumber[select.eq(5).text()]);
                            $("#createForm select[name='severity']").val(severityNumber[select.eq(7).text()]);
                            $("#createForm select[name='priority']").val(priorityNumber[select.eq(8).text()]);
                            $("input[name='user_id']").prop('hidden', true);
                            $("input[name='status']").prop('hidden', true);
                            $("input[name='group_id']").prop('hidden', true);

                            $("input[name='id']").prop('hidden', false);
                            $("#idDiv").show();
                            $("#createForm").attr('action', '/update/bug');
                        } else {
                            $("#createForm").attr('action', '#');
                        }
                        $(".dialog").show();
                    } else {
                        $(".dialog").hide();
                    }

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

                $("#DataTables_Table_0_filter").css({
                    'position': 'absolute',
                    'right': '274px'
                })

                let createUrl = this.createUrl;
                let editUrl = this.editUrl;
                let url = '';
                $("#typeSelect").change(function() {
                    switch ($('#dialogTitle').text()) {
                        case 'create':
                            url = createUrl[$(this).val()];
                            $("#createForm").attr('action', url);
                            break;
                        case 'update':
                            url = editUrl[$(this).val()];
                            if (typeof url == 'undefined') {
                                alert('尚未提供該項目編輯功能');
                                $("#createForm").attr('action', "#");
                                return;
                            }
                            $("#createForm").attr('action', url);
                            break;
                    }

                });
            },

        }
        const vm = new Vue(vueParam);
    </script>
    @endauth
</body>

</html>