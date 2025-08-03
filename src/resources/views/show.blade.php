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
                enctype="multipart/form-data">
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
            <div>
                <label for="name">商品名</label><br>
                <input type="text" name="name" id="name" value="{{ $product->name }}" placeholder="商品名を入力">
            </div>


            @error('name')
                <div class="error-alert">{{ $message }}</div>
            @enderror

            <div>
                <label for="price">値段</label><br>
                <input type="text" name="price" id="price" value="{{ $product->price }}" placeholder="値段を入力">
            </div>

            @error('price')
                <div class="error-alert">{{ $message }}</div>
            @enderror

            <div>
                <label for="season">季節</label><br>
                @foreach ($allSeasons as $season)
                    <input id="season" type="checkbox" name="seasons[]"
                        value="{{ $season->id }}"{{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                    {{ $season->name }}
                @endforeach
            </div>



            @error('seasons')
                <div class="error-alert">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div>
        <label for="description">商品説明</label><br>
        <textarea id="description" name="description" cols="30" rows="10" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
    </div>

    @error('description')
        <div class="error-alert">{{ $message }}</div>
    @enderror

    <div>
        <button type="button" onclick="location.href='{{ route('index') }}'">戻る</button>
        <button type="submit">変更を保存</button>
    </div>
    </form>

    <form action="{{ route('products.destroy', ['productId' => $product->id]) }}" method="post">
        @method('delete')
        @csrf
        <button class="product__card__delete" type="submit"><img src="{{ asset('storage/icons/Frame 406.png') }}"
                alt="ゴミ箱"></button>
    </form>
@endsection
