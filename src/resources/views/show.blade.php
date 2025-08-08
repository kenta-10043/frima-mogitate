@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="breadcrumb-item__link" href="{{ route('index') }}">一覧</a></li> &gt;
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="products__main">
        <div>
            <form action="{{ route('products.update', ['productId' => $product->id]) }}" method="post"
                enctype="multipart/form-data" novalidate>
                @method('put')
                @csrf

                <div class="products__card">
                    <img class="products__card__image" src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}">
                    <p><input id="image" type="file" name="image"></p>
                </div>


                @error('image')
                    <div class="error-alert">{{ $message }}</div>
                @enderror
        </div>

        <div class="products__contents">
            <div class="products__name">
                <label for="name">商品名</label><br>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                    placeholder="商品名を入力">
            </div>

            @error('name')
                <div class="error-alert">{{ $message }}</div>
            @enderror

            <div class="products__price">
                <label for="price">値段</label><br>
                <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}"
                    placeholder="値段を入力">
            </div>

            @error('price')
                <div class="error-alert">{{ $message }}</div>
            @enderror

            <div class="products__season">
                <label for="season">季節</label><br>
                @foreach ($allSeasons as $season)
                    <input id="season" type="checkbox" name="seasons[]"
                        value="{{ $season->id }}"{{ (is_array(old('seasons')) && in_array($season->id, old('seasons'))) || (!old('seasons') && $product->seasons->contains($season->id)) ? 'checked' : '' }}>
                    {{ $season->name }}
                @endforeach
            </div>

            @error('seasons')
                <div class="error-alert">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="products__description">
        <label for="description">商品説明</label><br>
        <textarea class="products__description__inner" id="description" name="description" cols="30" rows="10"
            placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
    </div>

    @error('description')
        <div class="error-alert">{{ $message }}</div>
    @enderror

    <div class="submit__button">
        <div class="submit__button__inner">
            <button class='submit__button__back' type="button" onclick="location.href='{{ route('index') }}'">戻る</button>
            <button Class='submit__button__update' type="submit">変更を保存</button>
        </div>
        </form>

        <form action="{{ route('products.destroy', ['productId' => $product->id]) }}" method="post">
            @method('delete')
            @csrf
            <button class="product__card__delete" type="submit"><img src="{{ asset('storage/icons/Frame 406.png') }}"
                    alt="ゴミ箱"></button>
        </form>
    </div>
@endsection
