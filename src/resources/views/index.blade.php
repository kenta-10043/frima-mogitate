@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="subheading">
        <h3 class="subheading__tittle">商品一覧</h3>
        <button class="subheading__button" type="button"
            onclick="location.href='{{ route('products.register') }}'">＋商品を追加</button>
    </div>
    <div class="main__contents">
        <aside class="sidebar">
            <form action="{{ route('products.search') }}" method="get">
                <input class="search" type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="商品名で検索">
                <button class="search__button" type="submit">検索</button>

                <h4>価格帯で表示</h4>
                <select class="search__reorder" name="sort">
                    <option value="">価格で並び替え</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>低い順に表示</option>
                </select>
            </form>

            <div class="search__reorder__tag">
                @isset($sort)
                    @if ($sort)
                        <p class="tag__item">
                            @switch($sort)
                                @case('price_desc')
                                    高い順に表示
                                @break

                                @case('price_asc')
                                    低い順に表示
                                @break
                            @endswitch

                            <button class="search__reorder__button" type="button"
                                onclick="location.href='{{ route('index') }}'">×</button>
                        </p>
                </div>
                @endif
            @endisset
        </aside>

        <div class="products__card">
            @foreach ($products as $product)
                <a class="products__card__link" href="{{ route('products.show', ['productId' => $product->id]) }}">
                    <img class="products__card__image" src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}">
                    <div class="products__card__contents">
                        <p class="products__card__inner">{{ $product->name }}</p>
                        <p class="products__card__inner">￥{{ $product->price }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{ $products->links('pagination::bootstrap-5') }}
@endsection
