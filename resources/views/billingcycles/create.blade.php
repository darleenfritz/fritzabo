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
        <a href="{{ route('billingcycles.index') }}" class="back-link">Zurück</a>
        <h2>Neuer Abrechnungszyklus</h2>
    </div>

    <form method="POST" action="{{ route('billingcycles.store') }}">
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

        <div class="mb-3">
            <label for="interval_in_days" class="form-label required">Intervall (in Tagen)</label>
            <input type="number" name="interval_in_days" id="interval_in_days"
                   class="form-control @error('interval_in_days') is-invalid @enderror"
                   value="{{ old('interval_in_days') }}">
            @error('interval_in_days')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pink">Speichern</button>
        </div>
    </form>
</div>
@endsection