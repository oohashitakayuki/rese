<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
  @yield('script')
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
</head>

<body>
  <div class="app">
    <header class="header">
      <input id="drawer__input" class="drawer__hidden" type="checkbox">
      <label for="drawer__input" class="drawer__open"><span></span></label>
      <nav class="nav__content">
      @auth
        <ul class="nav__menu">
          <li><a class="nav__item" href="/">Home</a></li>
          <form class="form" action="/logout" method="post">
          @csrf
          <button class="nav__logout">Logout</button>
          </form>
          <li><a class="nav__item" href="/mypage">Mypage</a></li>
        </ul>
        @endauth

        @guest
        <ul class="nav__menu">
          <li><a class="nav__item" href="/">Home</a></li>
          <li><a class="nav__item" href="/register">Registration</a></li>
          <li><a class="nav__item" href="/login">Login</a></li>
        </ul>
        @endguest
        </nav>
        <h1 class="header__heading">Rese</h1>
    </header>

    <main class=content>
      @yield('content')
    </main>
  </div>
</body>
</html>