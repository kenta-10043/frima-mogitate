@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @foreach ($products as $product)
        <p>{{ $product->name }}</p>
        <p>{{ $product->price }}</p>
        <p>{{ $product->image }}</p>
    @endforeach
@endsection



{{-- @foreach ($products as $product)
    <div>
        <p>商品名：{{ $product->name }}</p>
        <p>価格：￥{{ $product->price }}</p>
        <p>画像：<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"></p>
        <p>説明：{{ $product->description }}</p>
    </div>
@endforeach --}}
