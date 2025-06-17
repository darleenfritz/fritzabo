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

    h2 {
        color: #ec407a;
        margin: 0;
        text-align: center;
        font-size: 28px;
    }

    .back-btn {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
    }

    .back-btn:hover {
        background-color: #d81b60;
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
    }

    label.required::after {
        content: '*';
        color: #ec407a;
        margin-left: 4px;
    }
</style>

<div class="form-container">
    <div class="header-row">
        <a href="{{ route('billingcycles.index') }}" class="back-btn">Zurück</a>
        <h2>Abrechnungszyklus bearbeiten</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('billingcycles.update', $billingcycle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label required">Name</label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $billingcycle->name) }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="interval_in_days" class="form-label required">Intervall in Tagen</label>
            <input type="number" id="interval_in_days" name="interval_in_days"
                   class="form-control @error('interval_in_days') is-invalid @enderror"
                   value="{{ old('interval_in_days', $billingcycle->interval_in_days) }}" required>
            @error('interval_in_days')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn-pink">Speichern</button>
        </div>
    </form>
</div>
@endsection