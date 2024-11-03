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
              <span span class="material-icons">highlight_off</span>
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

        <a href="#reservation-change-modal-{{ $reservation->id }}" class="reservation-change modal-open">予約の変更</a>

        <div id="reservation-change-modal-{{ $reservation->id }}" class="reservation-change__modal">
          <a href="#!" class="reservation-change__modal-overlay"></a>
          <div class="reservation-change__modal-window">
            <div class="reservation-change__modal-content">
              <form action="{{ route('reservation.update', $reservation->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="reservation-change__group">
                  <input class="reservation-change__date" type="date" name="date">
                  <div class="reservation-change__error-message">
                    @error('date')
                    {{ $message }}
                    @enderror
                  </div>
                </div>

                <div class="reservation-change__group">
                  <select class="reservation-change__time" name="time">
                    <option disabled selected>選択して下さい</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                  </select>
                  <div class="reservation-change__error-message">
                    @error('time')
                    {{ $message }}
                    @enderror
                    </div>
                  </div>

                <div class="reservation-change__group">
                  <select class="reservation-change__number" name="number">
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
                  <div class="reservation-change__error-message">
                    @error('number')
                    {{ $message }}
                    @enderror
                  </div>
                </div>
                <div class="reservation-change__button">
                  <button class="reservation-change__button-submit" type="submit">変更する</button>
                </div>
              </form>
            </div>
            <a href="#!" class="reservation-change__modal-close">×</a>
          </div>
        </div>

        <a href="#review-upload-modal-{{ $reservation->shop->id }}" class="review-upload modal-open">レビューを投稿</a>

        <div id="review-upload-modal-{{ $reservation->shop->id }}" class="review-upload__modal">
          <a href="#!" class="review-upload__modal-overlay"></a>
          <div class="review-upload__modal-window">
            <div class="review-upload__modal-content">
              <form action="{{ route('review.store', $reservation->shop->id) }}" method="post">
                @csrf
                <div class="review-upload__group">
                  <div class="review-upload__star">
                    <span>
                      <input id="review05" type="radio" name="star" value="5"><label for="review05">★</label>
                      <input id="review04" type="radio" name="star" value="4"><label for="review04">★</label>
                      <input id="review03" type="radio" name="star" value="3"><label for="review03">★</label>
                      <input id="review02" type="radio" name="star" value="2"><label for="review02">★</label>
                      <input id="review01" type="radio" name="star" value="1"><label for="review01">★</label>
                    </span>
                  </div>
                </div>

                <div class="review-upload__group">
                  <textarea class="review-upload__comment" name="comment"></textarea>
                </div>
                <div class="review-upload__button">
                  <button class="review-upload__button-submit">投稿する</button>
                </div>
              </form>
            </div>
            <a href="#!" class="review-upload__modal-close">×</a>
          </div>
        </div>

        <a href="#qrcode-show-model-{{ $reservation->shop->id }}" class="qrcode-show modal-open">QRコード</a>

        <div id="qrcode-show-model-{{ $reservation->shop->id }}" class="qrcode-show__modal">
          <a href="#!" class="qrcode-show__modal-overlay"></a>
          <div class="qrcode-show__modal-window">
            <div class="qrcode-show__modal-content">
              {!! QrCode::generate(route('detail', $reservation->shop->id)) !!}
            </div>
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