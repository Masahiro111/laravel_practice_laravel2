<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ユーザー登録フォーム</title>
    </head>

    <body>
        <form name="registform" id="registform" action="/register" method="post">
            @csrf

            <dl>
                <dt>名前</dt>
                <dd><input type="text" name="name" size="20">
                    <span>{{ $errors->first('name') }}</span>
                </dd>
            </dl>
            <dl>
                <dt>メールアドレス</dt>
                <dd><input type="text" name="email" size="20">
                    <span>{{ $errors->first('email') }}</span>
                </dd>
            </dl>
            <dl>
                <dt>パスワード</dt>
                <dd><input type="password" name="password" size="20">
                    <span>{{ $errors->first('password') }}</span>
                </dd>
            </dl>
            <dl>
                <dt>パスワード（確認）</dt>
                <dd><input type="password" name="password_confirmation" size="20">
                    <span>{{ $errors->first('password_confirmation') }}</span>
                </dd>
            </dl>

            <button type="submit" name="action" value="send">送信</button>
        </form>

    </body>

</html>