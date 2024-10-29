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
            @method('delete')
            <button class="reservation-cancellation__button-submit">
              <span class="material-icons">highlight_off</span>
            </button>
          </form>
        </div>
        <table class="reservation-info__content">
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

        <a href="#modal-{{ $reservation->id }}" class="reservation-info__change">予約の変更</a>

        <div id="modal-{{ $reservation->id }}" class="modal">
          <a href="#!" class="modal-overlay"></a>
          <div class="modal-window">
            <div class="modal-content">
              <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="reservation-form__group">
                  <input id="reservation-date" class="reservation-form__date" type="date" name="date">
                  <div class="reservation-form__error-message">
                    @error('date')
                    {{ $message }}
                    @enderror
                  </div>
                </div>

                <div class="reservation-form__group">
                  <select id="reservation-time" class="reservation-form__time" name="time">
                    <option disabled selected>選択して下さい</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                  </select>
                  <div class="reservation-form__error-message">
                    @error('time')
                    {{ $message }}
                    @enderror
                    </div>
                  </div>

                <div class="reservation-form__group">
                  <select id="reservation-number" class="reservation-form__number" name="number">
                    <option disabled selected>選択して下さい</option>
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                    <option value="5">5人</option>
                    <option value="6">6人</option>
                    <option value="7">7人</option>
                    <option value="8">8人</option>
                  </select>
                  <div class="reservation-form__error-message">
                    @error('number')
                    {{ $message }}
                    @enderror
                  </div>
                </div>
                <button type="submit">変更する</button>
              </form>
            </div>
            <a href="#!" class="modal-close">×</a>
          </div>
        </div>
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
            <a  href="{{ route('detail', $favorite->shop->id) }}" class="shop-detail__link btn">詳しくみる</a>
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