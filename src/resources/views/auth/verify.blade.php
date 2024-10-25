@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="card">
    <div class="card__heading">メールアドレスの確認</div>

    <div class="card__content">
      ご登録いただいたメールアドレスに確認用のメールを送信しました。メールをご確認ください。<br>
      もし確認用メールが送信されていない場合は、下記をクリックしてください。<br>
      <form method="post" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">確認メールを再送信する</button>
      </form>
    </div>
  </div>
</div>
@endsection