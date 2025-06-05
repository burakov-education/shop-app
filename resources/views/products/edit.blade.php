@php
    /** @var \App\Models\Product $product */
@endphp
@extends('layout')

@section('content')
    <section class="container">
        <div class="d-flex flex-column justify-content-center form-container good">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4 fs-1">Edit good</h2>

                    @include('_all-errors')

                    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data" id="addGood">
                        @csrf

                        @include('products._form', compact('product'))

                        <button type="submit" class="btn btn-primary w-100 my-2 fs-2">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
