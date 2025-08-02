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
        <aside>
            <form action="{{ route('products.search') }}" method="get">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="商品名で検索">
                <button type="submit">検索</button>
            </form>
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

    {{ $products->links() }}
@endsection
