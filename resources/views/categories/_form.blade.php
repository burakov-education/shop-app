@php
    /** @var \App\Models\Category $category */
    $category = $category ?? null;
@endphp

<div class="mb-5">
    <label for="name" class="form-label fs-2">Name</label>
    <input type="text" id="name" name="name" placeholder="Enter category name"
           class="form-control fs-2 @error('name') is-invalid @enderror"
           value="{{ old('name', $category?->name) }}"
    >
    @error('name')
    <div class="invalid-feedback fs-3">{{ $message }}</div>
    @enderror
</div>

<div class="mb-5">
    <label for="description" class="form-label fs-2">Description</label>
    <textarea id="description" name="description" placeholder="Enter description"
              class="form-control fs-2 @error('description') is-invalid @enderror"
    >{{ old('description', $category?->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback fs-3">{{ $message }}</div>
    @enderror
</div>
