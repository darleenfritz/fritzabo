@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 700px;
        margin: 0 auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .header-row {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        position: relative;
    }
    .header-row h2 {
        margin: 0;
        color: #ec407a;
        text-align: center;
        flex-grow: 1;
    }
    .back-link {
        position: absolute;
        left: 0;
        background-color: #ccc;
        color: black;
        text-decoration: none;
        padding: 6px 14px;
        border-radius: 8px;
    }
    label.required::after {
        content: '*';
        color: red;
        margin-left: 4px;
    }
    .form-control {
        border-radius: 6px;
    }
    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
    }
</style>

<div class="form-container">
    <div class="header-row">
        <a href="{{ route('subscriptions.index') }}" class="back-link">Zurück</a>
        <h2>Neue Subscription anlegen</h2>
    </div>

    <form action="{{ route('subscriptions.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label required">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label required">Kontakt</label>
            <input type="text" class="form-control @error('contact') is-invalid @enderror"
                   id="contact" name="contact" value="{{ old('contact') }}">
            @error('contact')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label required">Preis</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror"
                   id="price" name="price" value="{{ old('price') }}">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subscribed_at" class="form-label">Startdatum</label>
            <input type="date" class="form-control @error('subscribed_at') is-invalid @enderror"
                   id="subscribed_at" name="subscribed_at" value="{{ old('subscribed_at') }}">
            @error('subscribed_at')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subscription_end" class="form-label">Enddatum</label>
            <input type="date" class="form-control @error('subscription_end') is-invalid @enderror"
                   id="subscription_end" name="subscription_end" value="{{ old('subscription_end') }}">
            @error('subscription_end')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mediatype_id" class="form-label">Medientyp</label>
            <select name="mediatype_id" id="mediatype_id" class="form-control @error('mediatype_id') is-invalid @enderror">
                <option value="">- bitte wählen -</option>
                @foreach ($mts as $mt)
                    <option value="{{ $mt->id }}" @selected($mt->id == old('mediatype_id'))>{{ $mt->name }}</option>
                @endforeach
            </select>
            @error('mediatype_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pink px-4 py-2">Speichern</button>
        </div>
    </form>
</div>
@endsection
