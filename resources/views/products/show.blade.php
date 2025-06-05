@php
/** @var \App\Models\Product $product */
@endphp

@extends('layout')

@section('content')
    <section class="container">
        <article class="card my-3">
            <div class="card-title bg-secondary bg-gradient p-3 text-light d-flex justify-content-between">
                <h3>{{ $product->name }}</h3>
                <a href="{{ route('products.delete', $product) }}" title="Delete good" class="btn-danger py-1 px-2 justify-content-center text-decoration-none fs-4">☠</a>
            </div>
            <div class="card-body d-flex justify-content-between flex-wrap">
                <div class="card-img d-flex justify-content-evenly flex-wrap">
                    @foreach($product->images as $image)
                        <img src="{{ asset($image) }}" class="card-img-good" alt="Название товара">
                    @endforeach
                </div>
                <div class="card-info">
                    <p class="card-text text-black-50"><span class="text-dark">About: </span>{{ $product->description }}</p>
                    <p class="card-text text-danger d-flex justify-content-end">{{ $product->price }} ₽</p>
                </div>
            </div>
        </article>
    </section>
@endsection
