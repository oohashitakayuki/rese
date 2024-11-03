@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/detail.js') }}"></script>
@endsection

@section('content')
<div class="shop-detail">
  <div class="shop-detail__container">
    <div class="shop-profile">
      <h3 class="shop-profile__name">{{ $shop->name }}</h3>
      <img class="shop-profile__image" src="{{ $shop->image }}" alt="">
      <p class="shop-profile__tag">#{{ $shop->area->name }}</p>
      <p class="shop-profile__tag">#{{ $shop->genre->name }}</p>
      <p class="shop-profile__about">{{ $shop->detail }}</p>
    </div>

    <div class="reservation-form">
      <h3 class="reservation-form__heading">予約</h3>
        <form class="reservation-form__inner" action="{{ route('done', $shop->id) }}" method="post">
          <input type="hidden" name="shop_id" value="{{ $shop->id }}">
          @csrf
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
              <option value="1人">1人</option>
              <option value="2人">2人</option>
              <option value="3人">3人</option>
              <option value="4人">4人</option>
              <option value="5人">5人</option>
              <option value="6人">6人</option>
              <option value="7人">7人</option>
              <option value="8人">8人</option>
            </select>
            <div class="reservation-form__error-message">
              @error('number')
              {{ $message }}
              @enderror
            </div>
          </div>

          <table class="reservation-form__confirm">
            <tr>
              <th>Shop</th>
              <td>{{ $shop->name }}</td>
            </tr>
            <tr>
              <th>Date</th>
              <td id="confirm-date"></td>
            </tr>
            <tr>
              <th>Time</th>
              <td id="confirm-time"></td>
            </tr>
            <tr>
              <th>Number</th>
              <td id="confirm-number"></td>
            </tr>
          </table>

          <div class="reservation-form__button">
            <button class="reservation-form__button-submit" type="submit">予約する</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection