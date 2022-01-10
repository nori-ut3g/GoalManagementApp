<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Title</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
aaa
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading"> ログイン </div>
                <div class="panel-body">

                        <form action="{{ url('/api/login') }}" method="POST">
{{--                            @csrf--}}
                            <div class="form-group">
                                <label for="email"> メールアドレス </label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                            </div>
                            <div class="form-group">
                                <label for="password"> パスワード </label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary"> 送信 </button>
                            </div>
                        </form>
                </div>
            </nav>
{{--            <div class="text-center">--}}
{{--                <a href="{{ route('password.request') }}"> パスワードの変更はこちらから </a>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

</body>
</html>
<script>

</script>
