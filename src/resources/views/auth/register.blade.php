@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form">
  <div class="register-form__heading">
    <p>Registration</p>
  </div>
  <form class="register-form__inner" action="/register" method="post" novalidate>
    @csrf
    <div class="register-form__group">
      <div class="register-form__group-content">
        <span class="account-icon material-icons">person</span><input class="register-form__input" type="text" name="name" value="{{ old('name') }}" placeholder="Username">
      </div>
      <div class="register-form__error-message">
        @error('name')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="register-form__group">
      <div class="register-form__group-content">
        <span class="email-icon material-icons">email</span><input class="register-form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
      </div>
      <div class="register-form__error-message">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="register-form__group">
      <div class="register-form__group-content">
        <span class="password-icon material-icons">lock</span><input class="register-form__input" type="password" name="password" placeholder="Password">
      </div>
      <div class="register-form__error-message">
        @error('password')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="register-form__button">
      <button class="register-form__button-submit btn" type="submit">登録</button>
    </div>
  </form>
</div>
@endsection