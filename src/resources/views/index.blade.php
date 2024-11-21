@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="shop">
  <form class="shop-search" action="/search" method="get">
    @csrf
    <div class="shop-search__area">
      <select class="shop-search__area-select" name="area_id">
        <option value="">All area</option>
        @foreach ($areas as $area)
        <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
      </select>
    </div>
    <span class="shop-search__border-left"></span>
    <div class="shop-search__genre">
      <select class="shop-search__genre-select" name="genre_id">
        <option value="">All genre</option>
        @foreach ($genres as $genre)
        <option option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
      </select>
    </div>
    <span class="shop-search__border-right"></span>
    <span class="search-icon material-icons">search</span>
    <div class="shop-search__keyword">
      <input class="shop-search__keyword-input" type="search" name="keyword" placeholder="       Search ..." value="{{ old('keyword') }}">
    </div>
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
        <a  href="{{ route('detail',$shop->id) }}" class="shop-detail__link btn">詳しくみる</a>
        @if (Auth::check())
        <form class="favorite__button" action="{{ Auth::user()->is_favorite($shop->id) ? route('favorite.destroy', $shop->id) : route('favorite.store', $shop->id) }}" method="post">
          <input type="hidden" name="shop_id" value="{{ $shop->id }}">
          @csrf
          @if (Auth::user()->is_favorite($shop->id))
            @method('delete')
          @endif
          <button class="favorite__button-submit {{ Auth::user()->is_favorite($shop->id) ? 'red' : 'gray' }}" type="submit">
            <span class="favorite-icon material-icons">favorite</span>
          </button>
        </form>
        @else
        <button class="favorite__button-submit" onclick="location.href='{{ route('login') }}'">
          <span class="favorite-icon material-icons">favorite</span>
        </button>
        @endif
      </div>
    </div>
  </div>
  @endforeach
  </div>
</div>
@endsection