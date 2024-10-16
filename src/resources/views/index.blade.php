@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="shop">
  <div class="shop__container">
    <form class="shop-search" action="/search" method="get">
      @csrf
      <select class="shop-search__select" name="area_id">
        <option value="">All area</option>
        @foreach ($areas as $area)
        <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
      </select>
      <select class="shop-search__select" name="genre_id">
        <option value="">All genre</option>
        @foreach ($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
      </select>
      <input class="shop-search__input" type="search" name="keyword" placeholder="Search ..." value="{{ old('keyword') }}">
    </form>

    <div class="shop-list">
    @foreach ($shops as $shop)
    <div class="shop__item">
      <img class="shop__image" src="{{ $shop->image }}" alt="">
      <div class="shop__content">
        <h3 class="shop__name">{{ $shop->name }}</h3>
        <div class="shop__tag">
          <p class="shop__area">#{{ $shop->area->name }}</p>
          <p class="shop__genre">#{{ $shop->genre->name }}</p>
        </div>
        <div class="shop__service">
          <button class="shop-detail__link btn" onclick="location.href='{{ route('detail', $shop->id) }}'">
            詳しくみる
          </button>
          @if (Auth::check())
          <form class="favorite__button" action="{{ Auth::user()->is_favorite($shop->id) ? route('favorite.destroy', $shop->id) : route('favorite.store', $shop->id) }}" method="post">
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            @csrf
            @if (Auth::user()->is_favorite($shop->id))
              @method('delete')
            @endif
            <button class="favorite__button-submit {{ Auth::user()->is_favorite($shop->id) ? 'red' : 'gray' }}" type="submit">
              <span class="material-icons">favorite</span>
            </button>
          </form>
          @else
          <button class="favorite__button-submit" onclick="location.href='{{ route('login') }}'">
            <span span class="material-icons">favorite</span>
          </button>
          @endif
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
</div>
@endsection