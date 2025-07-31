@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <aside>
        <form action="{{ route('products.search') }}" method="get">
            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="商品名で検索">
            <button type="submit">検索</button>
        </form>
    </aside>
    <div class="products__card">
        @foreach ($products as $product)
            <img class="products__card__image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <div class="products__card__contents">
                <p class="products__card__inner">{{ $product->name }}</p>
                <p class="products__card__inner">{{ '￥' . $product->price }}</p>
            </div>
    </div>
    @endforeach
    </div>
    {{ $products->links() }}
@endsection



{{-- @foreach ($products as $product)
    <div>
        <p>商品名：{{ $product->name }}</p>
        <p>価格：￥{{ $product->price }}</p>
        <p>画像：<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"></p>
        <p>説明：{{ $product->description }}</p>
    </div>
@endforeach --}}
