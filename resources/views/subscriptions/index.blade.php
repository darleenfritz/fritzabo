@extends('layouts.app')

@section('content')
<style>
.container-sub {
    max-width: 1000px;
    margin: 0 auto;
}
h2 {
    text-align: center;
    color: #ec407a;
    margin-bottom: 20px;
}
.view-toggle {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.view-toggle input[type="checkbox"] {
    display: none;
}
.view-toggle label {
    cursor: pointer;
    width: 50px;
    height: 26px;
    background: #ccc;
    border-radius: 13px;
    position: relative;
}
.view-toggle label::before {
    content: '';
    position: absolute;
    width: 22px;
    height: 22px;
    background: white;
    border-radius: 50%;
    top: 2px;
    left: 2px;
    transition: 0.3s;
}
.view-toggle input:checked + label::before {
    transform: translateX(24px);
}
.view-toggle input:checked + label {
    background: #ec407a;
}
.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}
.card {
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    padding: 20px;
    width: 30%;
    position: relative;
}
.card h3 {
    color: #ec407a;
    margin-top: 0;
}
.card .id {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #ccc;
    font-weight: bold;
}
.card .actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.card .actions a,
.card .actions form button {
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    border: none;
}
.details-btn { background-color: #f48fb1; }
.edit-btn { background-color: #ba68c8; }
.delete-btn { background-color: #e57373; }

.list-mode .card-container {
    flex-direction: column;
    align-items: center;
}
.list-mode .card {
    width: 100% !important;
}
.filter-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.filter-row input,
.filter-row select {
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* Autocomplete Styles */
.autocomplete-wrapper {
    position: relative;
    width: 100%;
}
.suggestions-box {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border: 1px solid #ccc;
    max-height: 150px;
    overflow-y: auto;
    width: 100%;
    z-index: 999;
    border-radius: 4px;
}
.suggestions-box div {
    padding: 6px 12px;
    cursor: pointer;
}
.suggestions-box div:hover {
    background-color: #f1f1f1;
}
</style>

<div class="container-sub">
    <div style="display: flex; justify-content: flex-end; margin-bottom: -10px;">
        <a href="{{ route('subscriptions.create') }}" title="Neue Subscription" style="
            display: inline-block;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #ec407a;
            color: white;
            font-size: 24px;
            text-align: center;
            line-height: 36px;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        ">+</a>
    </div>
    


    <h2>Liste der Subscriptions</h2>

    <form method="GET" action="{{ route('subscriptions.index') }}">
        <div class="filter-row">
            <div class="autocomplete-wrapper">
                <input id="search" type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Nach Name suchen..." style="width: 100%;">
                <div id="suggestions" class="suggestions-box" style="display: none;"></div>
            </div>

            <select name="sort" onchange="this.form.submit()">
                <option value="">Sortieren nach</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Preis aufsteigend</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Preis absteigend</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                <option value="active" {{ request('sort') == 'active' ? 'selected' : '' }}>Nur aktive Abos</option>
                <option value="expired" {{ request('sort') == 'expired' ? 'selected' : '' }}>Nur abgelaufene Abos</option>
            </select>
        </div>

        <div class="filter-row">
            <input type="number" name="min_price" placeholder="Min Preis" value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Max Preis" value="{{ request('max_price') }}">

            <button type="submit" style="padding: 8px 16px; border-radius: 8px; background: #ec407a; color: white; border: none;">Filtern</button>
            <a href="{{ route('subscriptions.index') }}" style="padding: 8px 16px; border-radius: 8px; background: #ccc; color: black; text-decoration: none;">Zurücksetzen</a>

            <input type="hidden" name="view" id="viewInput" value="{{ request('view', 'grid') }}">
        </div>
    </form>

    <div class="view-toggle">
        <input type="checkbox" id="toggleView" {{ request('view', 'grid') == 'list' ? 'checked' : '' }}>
        <label for="toggleView"></label>
    </div>

    <div id="cardContainer" class="card-container {{ request('view', 'grid') == 'list' ? 'list-mode' : '' }}">
        @foreach ($subs as $sub)
            <div class="card">
                <div class="id">{{ $sub->id }}</div>
                <h3>{{ $sub->name }}</h3>
                <p><strong>Kontakt:</strong> {{ $sub->contact }}</p>
                <p><strong>Preis:</strong> {{ $sub->price }} €</p>
                <p><strong>Start:</strong>
                    {{ $sub->subscribed_at ? $sub->subscribed_at->translatedFormat('d. F Y') : '—' }}
                </p>
                <p><strong>Ende:</strong>
                    {{ $sub->subscription_end ? $sub->subscription_end->translatedFormat('d. F Y') : '—' }}
                </p>

                <div class="actions">
                    <a class="details-btn" href="{{ route('subscriptions.show', $sub) }}">Details</a>
                    <a class="edit-btn" href="{{ route('subscriptions.edit', $sub) }}">Bearbeiten</a>
                    <form action="{{ route('subscriptions.destroy', $sub->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" onclick="return confirm('Möchtest du wirklich das Abo beenden?')">Abo beenden</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
document.getElementById('toggleView').addEventListener('change', function() {
    const viewMode = this.checked ? 'list' : 'grid';
    const url = new URL(window.location.href);
    url.searchParams.set('view', viewMode);
    window.location.href = url.toString();
});

// Autocomplete
const searchInput = document.getElementById('search');
const subs = @json($subs->pluck('name'));
const suggestionsBox = document.getElementById('suggestions');

searchInput.addEventListener('input', function () {
    const query = this.value.toLowerCase().trim();
    suggestionsBox.innerHTML = '';

    if (query.length > 0) {
        const matches = subs.filter(name => name.toLowerCase().includes(query));
        matches.forEach(match => {
            const div = document.createElement('div');
            div.textContent = match;
            div.addEventListener('click', () => {
                searchInput.value = match;
                suggestionsBox.style.display = 'none';
            });
            suggestionsBox.appendChild(div);
        });
        suggestionsBox.style.display = matches.length > 0 ? 'block' : 'none';
    } else {
        suggestionsBox.style.display = 'none';
    }
});

document.addEventListener('click', function(e) {
    if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
        suggestionsBox.style.display = 'none';
    }
});
</script>

@endsection