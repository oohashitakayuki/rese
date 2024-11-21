@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-form">
  <div class="login-form__heading">
    <p>Login</p>
  </div>
  <form class="login-form__inner" action="/login" method="post" novalidate>
    @csrf
    <div class="login-form__group">
      <div class="login-form__group-content">
        <span class="email-icon material-icons">email</span><input class="login-form__input" type="email" name="email" value="{{ old('email') }}"  placeholder="Email">
      </div>
      <div class="login-form__error-message">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="login-form__group">
      <div class="login-form__group-content">
        <span class="password-icon material-icons">lock</span><input class="login-form__input" type="password" name="password"  placeholder="Password">
      </div>
      <div class="login-form__error-message">
        @error('password')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="login-form__button">
      <button class="login-form__button-submit btn" type="submit">ログイン</button>
    </div>
  </form>
</div>
@endsection