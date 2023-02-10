@extends("layouts.main")
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Register</h2>
                <form id="form" action="{{route('api.auth.register')}}" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button id="form_btn" type="button" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $().ready(function () {
            $.removeCookie("token");
            $("#form_btn").on('click', function () {
                let form_element = $("#form");
                $.ajax({
                    url: form_element.attr('action'),
                    method: "POST",
                    data: form_element.serialize(),
                    success: function (res) {
                        if (res.status) {
                            alert("註冊成功,請重新登入");
                            location.href = "{{route('auth.login')}}";
                            return false;
                        }
                    },
                    error: function (err) {
                        alert(err.responseJSON.message);
                        return false;
                    },
                });
                return false;
            });
        });
    </script>
@endpush
