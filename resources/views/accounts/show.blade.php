@extends("layouts.main")
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">存取款紀錄</h2>
                <div style="padding-bottom: 1rem">
                    <button id="modal_btn" class="btn btn-primary btn-sm" data-toggle="modal">新增</button>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">金額</th>
                        <th scope="col">存款額度</th>
                        <th scope="col">時間</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增明細</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal_form" action="{{$Html->actions->balance_uri}}" method="post">
                        <div class="form-group">
                            <label for="type-name" class="col-form-label">類別:</label>
                            <select id="type" name="type" class="form-control">
                                <option value="1">收入</option>
                                <option value="2">支出</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label">金額:</label>
                            <input type="number" min="0" value="0" class="form-control" id="amount" name="amount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="modal_submit">確認</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.0/mustache.min.js"></script>
    <script type="text/x-mustache" id="list_template">
    <tr>
        <th scope="row">@{{ amount }}</th>
        <td>@{{ balance }}</td>
        <td>@{{ created_at }}</td>
    </tr>
    </script>
    <script>
        $().ready(function () {
            getList();
            $("#modal_btn").on('click', function () {
                $("#modal").modal('show');
                return false;
            });
            $("#modal_submit").on('click', function () {
                if (confirm("確定要送出嗎?")) {
                    store();
                }
                return false;
            });

        });

        function getList() {
            $.ajax({
                url: "{{$Html->actions->account_uri}}",
                method: "GET",
                success: function (res) {
                    if (res.status) {
                        render(res.data);
                    }
                    return false;
                },
                error: function (err) {
                    alert(err.responseJSON.message);
                    location.href = "{{route("account.index")}}";
                    return false;
                },
            });
        }

        function store() {
            let element = $("#modal_form");
            $.ajax({
                url: element.attr('action'),
                method: element.attr('method'),
                data: element.serialize(),
                success: function (res) {
                    if (res.status) {
                        alert("新增成功");
                    }
                    location.reload();
                    return false;
                },
                error: function (err) {
                    alert(err.responseJSON.message);
                    return false;
                },
            });
        }

        function render(Data) {
            let template = $("#list_template").html();
            let element = $("#tbody");
            let html = '';
            for (let i = 0; i < Data.balances.length; i++) {
                html += Mustache.render(template, {
                    amount: Data.balances[i].amount,
                    balance: Data.balances[i].balance,
                    created_at: Data.balances[i].created_at,
                });
            }
            element.html(html);
        }
    </script>
@endpush
