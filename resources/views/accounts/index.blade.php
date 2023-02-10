@extends("layouts.main")
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Balance</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">用戶ID</th>
                        <th scope="col">帳號</th>
                        <th scope="col">存款額度</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.0/mustache.min.js"></script>
    <script type="text/x-mustache" id="list_template">
    <tr>
        <th scope="row">@{{ user_id }}</th>
        <td>@{{ account }}</td>
        <td>@{{ balance }}</td>
        <td>
           <a href="@{{ show_uri }}" type="button" class="btn btn-primary btn-sm">Detail</a>
        </td>
    </tr>

    </script>
    <script>
        $().ready(function () {
            $.ajax({
                url: "{{route('api.account.index')}}",
                method: "GET",
                success: function (res) {
                    if (res.status) {
                        render(res.data);
                    }
                    return false;
                },
                error: function (err) {
                    alert(err.responseJSON.message);
                    location.href = err.responseJSON.redirect_uri;
                    return false;
                },
            });
        });

        function render(Data) {
            console.log(Data);
            let template = $("#list_template").html();
            let element = $("#tbody");
            let html = '';
            for (let i = 0; i < Data.length; i++) {
                html += Mustache.render(template, {
                    user_id: Data[i].user_id,
                    account: Data[i].account,
                    balance: Data[i].balance,
                    show_uri:Data[i].actions['show_uri'],
                });
            }
            element.html(html);
        }
    </script>
@endpush
