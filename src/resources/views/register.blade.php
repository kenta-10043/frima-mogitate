@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="products__main">
        <div class="product__contents">
            <h2 class="product__contents__tittle">商品登録</h2>

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" novalidate >
                @csrf

                <div class="form__input">
                    <label for="name">商品名</label>
                    <span class="from__input__require">必須</span><br>
                    <input class="form__input__name" id="name" type="text" name="name"
                        value="{{ old('name') }}" placeholder="商品名を入力">
                </div>

                @error('name')
                    <div class="error-alert">{{ $message }}</div>
                @enderror

                <div class="form__input">
                    <label for="price">値段</label>
                    <span class="from__input__require">必須</span><br>
                    <input class="form__input__price" id="price" type="text" name="price"
                        value="{{ old('price') }}" placeholder="値段を入力">
                </div>

                @error('price')
                    <div class="error-alert">{{ $message }}</div>
                @enderror

                <div class="form__input">
                    <label for="image">商品画像</label>
                    <span class="from__input__require">必須</span><br>
                    <input class="form__input__image" id="image" type="file" name="image">
                </div>

                @error('image')
                    <div class="error-alert">{{ $message }}</div>
                @enderror

                <div class="form__input">
                    <label for="season">季節</label>
                    <span class="from__input__require">必須</span><span class="choice">複数選択可</span><br>
                    <input class="form__input__season" id="season" type="checkbox" name="seasons[]" value="1"
                        {{ is_array(old('seasons')) && in_array(1, old('seasons')) ? 'checked' : '' }}>春
                    <input type="checkbox" name="seasons[]" value="2"
                        {{ is_array(old('seasons')) && in_array(2, old('seasons')) ? 'checked' : '' }}>夏
                    <input type="checkbox" name="seasons[]" value="3"
                        {{ is_array(old('seasons')) && in_array(3, old('seasons')) ? 'checked' : '' }}>秋
                    <input type="checkbox" name="seasons[]" value="4"
                        {{ is_array(old('seasons')) && in_array(4, old('seasons')) ? 'checked' : '' }}>冬
                </div>

                @error('seasons')
                    <div class="error-alert">{{ $message }}</div>
                @enderror

                <div class="form__input">
                    <label for="description">商品説明</label>
                    <span class="from__input__require">必須</span><br>
                    <textarea class="form__input__description" id="description" name="description" cols="30" rows="10"
                        placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                </div>

                @error('description')
                    <div class="error-alert">{{ $message }}</div>
                @enderror

                <div class="form__button">
                    <button class='submit__button__register' type="submit">登録</button>
                    <button class='submit__button__back' type="button"
                        onclick="location.href='{{ route('index') }}'">戻る</button>
                </div>
            </form>
        </div>
    </div>
@endsection
