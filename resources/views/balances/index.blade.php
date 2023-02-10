@extends("layouts.main")
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Balance</h2>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $().ready(function () {
            $.ajax({
                url: "{{route('api.balance.index')}}",
                method: "GET",
                headers: {
                    Authorization: 'Bearer ' + $.cookie("token")
                },
                success: function (res) {
                    console.log(res);
                    return false;
                },
                error: function (err) {
                    alert(err.responseJSON.message);
                    location.href = err.responseJSON.redirect_uri;
                    return false;
                },
            });
        });
    </script>
@endpush
