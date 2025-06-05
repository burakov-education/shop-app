@php
/** @var \App\Models\Category[] $categories */
@endphp

@extends('layout')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Categories</h1>

        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('categories.create') }}" class="btn btn-primary fs-3">Add category</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle fs-5">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Count</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->products()->count() }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('categories.show', $category) }}" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                                    <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="eye" class="action-image">
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" type="button" class="btn btn-lg btn-outline-success no-reverse">
                                    <img src="{{ asset('assets/img/icons/pencil.svg') }}" alt="eye" class="action-image">
                                </a>
                                @if ($category->products()->count() === 0)
                                    <a href="{{ route('categories.delete', $category) }}" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                                        <img src="{{ asset('assets/img/icons/trash.svg') }}" alt="eye" class="action-image">
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
