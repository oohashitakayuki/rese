@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
  <p class="mypage__user-authentication">
    {{ Auth::user()->name }}さん
  </p>
  <div class="mypage__container">
    <div class="reservation-list">
      <p class="reservation-list__heading content__heading">予約状況</p>
      <div class="reservation-list__inner">
      @foreach ($reservations as $reservation)
      <div class="reservation-info">
        <div class="reservation-info__heading">
          <span class="material-icons">schedule</span>
          <p class="reservation-info__number">予約</p>
          <form class="reservation-cancellation__button" action="{{ route('reservation.destroy', $reservation->shop->id) }}" method="post">
            <input type="hidden" name="shop_id" value="{{ $reservation->shop->id }}">
            @csrf
            @method('DELETE')
            <button class="reservation-cancellation__button-submit">
              <span class="material-icons">highlight_off</span>
            </button>
          </form>
        </div>
        <table class="reservation-detail">
          <tr>
            <th>Shop</th>
            <td>{{ $reservation->shop->name }}</td>
          </tr>
          <tr>
            <th>Date</th>
            <td>{{ $reservation->date }}</td>
          </tr>
          <tr>
            <th>Time</th>
            <td>{{ $reservation->time }}</td>
          </tr>
          <tr>
            <th>Number</th>
            <td>{{ $reservation->number }}</td>
            </tr>
        </table>
      </div>
      @endforeach
      </div>
    </div>

    <div class="favorite-list">
      <p class="favorite-list__heading content__heading">お気に入り店舗</p>
      <div class="favorite-list__inner">
      @foreach ($favorites as $favorite)
      <div class="favorite__item">
        <img class="shop__image" src="{{ $favorite->shop->image }}" alt="">
        <div class="shop__content">
          <h3 class="shop__name">{{ $favorite->shop->name }}</h3>
          <div class="shop__tag">
            <p class="shop__area">#{{ $favorite->shop->area->name }}</p>
            <p class="shop__genre">#{{ $favorite->shop->genre->name }}</p>
          </div>
          <div class="shop__service">
            <button class="shop-detail__link btn" onclick="location.href='{{ route('detail', $favorite->shop->id) }}'">
              詳しくみる
            </button>
            <form class="favorite-cancellation__button" action="{{ route('favorite.destroy', $favorite->shop->id) }}" method="post">
              <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
              @csrf
              @method('DELETE')
              <button class="favorite-cancellation__button-submit">
                <span class="material-icons">favorite</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
      </div>
    </div>
  </div>
</div>
@endsection