@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify.css') }}">
@endsection

@section('content')
<div class="verify-page">
  <div class="verify-page__heading">メールアドレスの確認</div>
  <div class="verify-page__inner">
    <div class="verify-page__message">
      <p>ご登録いただいたメールアドレスに確認用のメールを送信しました。<br>メールをご確認ください。</p>
      <p>もし確認用メールが送信されていない場合は、下記をクリックしてください。</p>
    </div>
    <form class="verify-page__button" method="post" action="{{ route('verification.send') }}">
      @csrf
      <button class="verify-page__button-submit btn" type="submit">確認メールを再送信する</button>
    </form>
  </div>
</div>
@endsection