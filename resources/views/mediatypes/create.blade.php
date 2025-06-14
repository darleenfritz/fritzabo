@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 600px;
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
        flex-grow: 1;
        text-align: center;
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
        color: #ec407a;
        margin-left: 4px;
    }

    .form-control {
        border-radius: 6px;
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
    }
</style>

<div class="form-container">
    <div class="header-row">
        <a href="{{ route('mediatypes.index') }}" class="back-link">Zurück</a>
        <h2>Neuer Medientyp</h2>
    </div>

    <form method="POST" action="{{ route('mediatypes.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label required">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Wenn Du später eine Beschreibung nutzen willst, hier einkommentieren:
        <div class="mb-3">
            <label for="description" class="form-label">Beschreibung</label>
            <textarea name="description" id="description"
                      class="form-control">{{ old('description') }}</textarea>
        </div>
        --}}

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pink">Speichern</button>
        </div>
    </form>
</div>
@endsection
