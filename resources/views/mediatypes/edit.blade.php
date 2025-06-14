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
    .subscriptions-list {
        margin-top: 40px;
    }
    .subscriptions-list ul {
        padding-left: 18px;
    }
    .subscriptions-list li {
        margin-bottom: 6px;
    }
</style>

<div class="form-container">
    <div class="header-row">
        <a href="{{ route('mediatypes.index') }}" class="back-btn">Zurück</a>
        <h2>Medientyp bearbeiten</h2>
    </div>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form action="{{ route('mediatypes.update', $mediatype->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $mediatype->name) }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        <div class="text-end">
            <button type="submit" class="btn-pink">Speichern</button>
        </div>
    </form>

    @if ($mediatype->subscriptions->count())
    <div class="subscriptions-list mt-4 p-3" style="
        background-color: #fdf2f8;
        border: 1px solid #f8bbd0;
        border-radius: 10px;
    ">
        <h5 style="color: #ec407a; font-weight: bold; margin-bottom: 12px;">
            Zugehörige Subscriptions ({{ $mediatype->subscriptions->count() }})
        </h5>
        <ul style="list-style: none; padding-left: 0; margin: 0;">
            @foreach($mediatype->subscriptions as $sub)
                <li style="
                    margin-bottom: 10px;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                    transition: background 0.2s ease;
                ">
                    <a href="{{ route('subscriptions.show', $sub) }}" style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 10px 14px;
                        border-radius: 8px;
                        color: #ec407a;
                        text-decoration: none;
                        font-weight: 500;
                    " onmouseover="this.style.background='#fce4ec'" onmouseout="this.style.background='white'">
                        <span>{{ $sub->name }}</span>
                        <span style="color: #7b1fa2; font-size: 14px;">{{ number_format($sub->price, 2, ',', '.') }} €</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
</div>
@endsection