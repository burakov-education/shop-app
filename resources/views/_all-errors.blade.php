@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */

    $errors = $errors ?? null;
@endphp

@if ($errors?->any())
    <div class="alert alert-danger fs-2" id="errorMessage">
        @foreach($errors->getMessages() as $field => $error)
            <div>{{ ucfirst($field) }}: {{ $error[0] }}</div>
        @endforeach
    </div>
@endif
