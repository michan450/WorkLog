<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<header class="header">
    <div class="header__logo">COACHTECH</div>
</header>

<main class="main">
  <div class="container">
    <h1>会員登録</h1>

    <form method="POST" action="/register">
    @csrf

    <div class="form__group">
        <label>お名前</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p style="color:red;margin-top: 5px;">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p style="color:red;margin-top: 5px;" >{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <label>パスワード</label>
        <input type="password" name="password">
        @error('password')
            <p style="color:red;margin-top: 5px;">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <label>確認用パスワード</label>
        <input type="password" name="password_confirmation">
    </div>

    <button type="submit" class="btn">登録する</button>
    </form>

    <a href="/login" class="link">ログインはこちら</a>
  </div>

</main>
</body>
</html>