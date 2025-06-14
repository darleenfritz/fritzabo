@extends('layouts.app')

@section('content')

<style>
.container-mt {
    max-width: 1000px;
    margin: 0 auto;
}
h2 {
    color: #ec407a;
    text-align: center;
    margin-bottom: 20px;
}
.add-btn {
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
}
.add-btn:hover {
    background-color: #d81b60;
    color: white;
}
.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
}
.card {
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.card-content {
    flex-grow: 1;
}
.card h4 {
    margin-top: 0;
    color: #ec407a;
}
.card h4 a {
    color: #ec407a;
    text-decoration: none;
}
.card .count {
    font-size: 14px;
    color: #888;
    margin-bottom: 10px;
}
.card ul {
    margin-top: 10px;
    padding-left: 0;
    list-style: none;
}
.card ul li {
    margin-bottom: 6px;
}
.actions {
    margin-top: auto;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.actions form {
    display: inline;
}
.actions .btn {
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    border: none;
    cursor: pointer;
}
.btn-edit { background-color: #ba68c8; }
.btn-edit:hover { background-color: #9c4dcc; color: white; }
.btn-delete { background-color: #e57373; }
.btn-delete:hover { background-color: #d32f2f; color: white; }
.id-badge {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #ccc;
    font-weight: bold;
}
.filter-row {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}
.filter-row .autocomplete-wrapper {
    flex: 1;
}
.filter-row select {
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #ccc;
    height: 40px;
    width: 180px;
}
.autocomplete-wrapper {
    position: relative;
    width: 100%;
}
.autocomplete-wrapper input {
    width: 100%;
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #ccc;
    height: 40px;
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

<div class="container container-mt">
    <div style="margin-bottom: 10px; text-align: right;">
        <a href="{{ route('mediatypes.create') }}" class="add-btn">+</a>
    </div>

    <h2>Liste der Medientypen</h2>

    <form method="GET" action="{{ route('mediatypes.index') }}">
        <div class="filter-row">
            <div class="autocomplete-wrapper">
                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Nach Name suchen...">
                <div id="suggestions" class="suggestions-box" style="display: none;"></div>
            </div>

            <select name="sort" onchange="this.form.submit()">
                <option value="">Sortieren nach</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
            </select>
        </div>
    </form>

    <div class="card-grid">
        @foreach ($mts as $mt)
            <div class="card">
                <div class="id-badge">{{ $mt->id }}</div>
                <div class="card-content">
                    <h4><a href="{{ route('mediatypes.show', $mt) }}">{{ $mt->name }}</a></h4>
                    <div class="count">{{ $mt->subscriptions->count() }} Subscriptions</div>

                    @if ($mt->subscriptions->isEmpty())
                        <p><em>Keine zugehörigen Subscriptions</em></p>
                    @else
                        <ul>
                            @foreach ($mt->subscriptions as $sub)
                                <li>
                                    <a href="{{ route('subscriptions.show', $sub) }}" style="display: flex; justify-content: space-between; text-decoration: none; padding: 6px 10px; background: #f8f8f8; border-radius: 6px; border: 1px solid #eee; color: #333;">
                                        <span>{{ $sub->name }}</span>
                                        <span style="color: #888;">{{ number_format($sub->price, 2, ',', '.') }} €</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="actions">
                    <a class="btn btn-edit" href="{{ route('mediatypes.edit', $mt) }}">Bearbeiten</a>
                    <a href="{{ route('mediatypes.export', $mt->id) }}" class="btn" style="background-color: #90caf9;">Exportieren</a>
                    <form method="POST" action="{{ route('mediatypes.destroy', $mt) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" onclick="return confirm('Wirklich löschen?')">Löschen</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
const searchInput = document.getElementById('search');
const suggestionsBox = document.getElementById('suggestions');
const mediatypes = @json($mts->pluck('name'));

searchInput.addEventListener('input', function () {
    const query = this.value.toLowerCase().trim();
    suggestionsBox.innerHTML = '';

    if (query.length > 0) {
        const matches = mediatypes.filter(name => name.toLowerCase().includes(query));
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