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
        content: ' *';
        color: #ec407a !important;
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
        <h2>Subscription bearbeiten</h2>
    </div>

    <form action="{{ route('subscriptions.update', $sub->id) }}" method="post">
        @csrf
        @method("PUT")

        <div class="mb-3">
            <label for="name" class="form-label required">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $sub->name) }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label required">Kontakt</label>
            <input type="text" class="form-control @error('contact') is-invalid @enderror"
                   id="contact" name="contact" value="{{ old('contact', $sub->contact) }}">
            @error('contact')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label required">Preis</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror"
                   id="price" name="price" value="{{ old('price', $sub->price) }}">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subscribed_at" class="form-label">Startdatum</label>
            <input type="text" class="form-control @error('subscribed_at') is-invalid @enderror"
                   id="subscribed_at" name="subscribed_at"
                   value="{{ old('subscribed_at', optional($sub->subscribed_at)->format('d.m.Y')) }}">
            @error('subscribed_at')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subscription_end" class="form-label">Enddatum</label>
            <input type="text" class="form-control @error('subscription_end') is-invalid @enderror"
                   id="subscription_end" name="subscription_end"
                   value="{{ old('subscription_end', optional($sub->subscription_end)->format('d.m.Y')) }}">
            @error('subscription_end')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mediatype_id" class="form-label">Medientyp</label>
            <select name="mediatype_id" id="mediatype_id" class="form-control @error('mediatype_id') is-invalid @enderror">
                <option value="">- bitte wählen -</option>
                @foreach ($mts as $mt)
                    <option value="{{ $mt->id }}" @selected($mt->id == old('mediatype_id', $sub->mediatype_id))>{{ $mt->name }}</option>
                @endforeach
            </select>
            @error('mediatype_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="billingcycle_id" class="form-label">Abrechnungszyklus</label>
            <select name="billingcycle_id" id="billingcycle_id" class="form-control @error('billingcycle_id') is-invalid @enderror">
                <option value="">- bitte wählen -</option>
                @foreach ($billingcycles as $cycle)
                    <option value="{{ $cycle->id }}" @selected(old('billingcycle_id', $sub->billingcycle_id) == $cycle->id)>
                        {{ $cycle->name }}
                    </option>
                @endforeach
            </select>
            @error('billingcycle_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pink px-4 py-2">Speichern</button>
        </div>
    </form>
</div>

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/de.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#subscribed_at", {
                dateFormat: "d.m.Y",
                locale: "de"
            });

            flatpickr("#subscription_end", {
                dateFormat: "d.m.Y",
                locale: "de"
            });
        });
    </script>
@endpush



@endsection