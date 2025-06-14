@extends('layouts.app')

@section('content')

<style>
.container-show {
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    position: relative;
}
h2 {
    text-align: center;
    color: #ec407a;
    margin-bottom: 20px;
}
.table-wrapper {
    overflow-x: auto;
}
.table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}
.table td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}
.table td:first-child {
    font-weight: bold;
    width: 40%;
    color: #666;
}
.status-badge {
    padding: 4px 10px;
    border-radius: 6px;
    color: white;
    display: inline-block;
}
.status-aktiv {
    background-color: #66bb6a;
}
.status-abgelaufen {
    background-color: #ef5350;
}
.actions {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
}
.actions-left {
    display: flex;
    gap: 10px;
}
.actions-right {
    display: flex;
    gap: 10px;
}
.actions a {
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    display: inline-block;
}
.back-btn { background-color: #ccc; color: black; }
a.edit-btn,
button.edit-btn {
    background-color: #ba68c8;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    cursor: pointer;
}
a.edit-btn:hover,
button.edit-btn:hover {
    background-color: #9c4dcc;
    color: white;
}
.nav-btn { background-color: #ec407a; }
.print-btn {
    position: absolute;
    top: 20px;
    right: 30px;
    background-color: #f48fb1;
    color: white;
    padding: 6px 14px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.extend-btn {
    background-color: #f48fb1;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    text-decoration: none;
    cursor: pointer;
    font-size: 14px;
}
.extend-btn:hover {
    background-color: #ec407a;
}
@media print {
    .actions, .print-btn {
        display: none !important;
    }
    .container-show {
        box-shadow: none;
        padding: 0;
    }
}
</style>

<div class="container-show">
    <button class="print-btn" onclick="window.print()">Drucken</button>

    <h2>Subscription für {{ $sub->name }}</h2>

    @php
        use Carbon\Carbon;
        $start = Carbon::parse($sub->subscribed_at);
        $end = Carbon::parse($sub->subscription_end);
        $days = $start->diffInDays($end);
        $status = $end->isPast() ? 'Abgelaufen' : 'Aktiv';

        $prev = \App\Models\Subscription::where('id', '<', $sub->id)->orderBy('id', 'desc')->first();
        $next = \App\Models\Subscription::where('id', '>', $sub->id)->orderBy('id', 'asc')->first();
    @endphp

    <div class="table-wrapper">
        <table class="table">
            <tr><td>ID</td><td>{{ $sub->id }}</td></tr>
            <tr><td>Name</td><td>{{ $sub->name }}</td></tr>
            <tr><td>Kontakt</td><td>{{ $sub->contact }}</td></tr>
            <tr><td>Kategorie</td><td>{{ $sub->mediatype->name ?? '–' }}</td></tr>
            <tr><td>Preis</td><td>{{ $sub->price }} €</td></tr>
            <tr><td>Start</td><td>{{ $start->format('d.m.Y') }}</td></tr>
            <tr><td>Ende</td><td>{{ $end->format('d.m.Y') }}</td></tr>
            <tr><td>Dauer</td><td>{{ $days }} Tage</td></tr>
            <tr>
                <td>Status</td>
                <td>
                    <span class="status-badge {{ $status === 'Aktiv' ? 'status-aktiv' : 'status-abgelaufen' }}">
                        {{ $status }}
                    </span>
                </td>
            </tr>
            <tr><td>Erstellt am</td><td>{{ Carbon::parse($sub->created_at)->format('d.m.Y H:i') }}</td></tr>
            <tr><td>Aktualisiert am</td><td>{{ Carbon::parse($sub->updated_at)->format('d.m.Y H:i') }}</td></tr>
        </table>
    </div>

    <div class="actions">
        <div class="actions-left">
            <a class="back-btn" href="{{ route('subscriptions.index') }}">Zurück</a>
            <a class="edit-btn" href="{{ route('subscriptions.edit', $sub) }}">Bearbeiten</a>
            @if ($status === 'Aktiv')
                <form method="POST" action="{{ route('subscriptions.extend', $sub) }}">
                    @csrf
                    <button class="edit-btn" onclick="return confirm('Abo wirklich um 1 Jahr verlängern?')">+1 Jahr verlängern</button>
                </form>
            @endif
        </div>
        <div class="actions-right">
            @if ($prev)
                <a class="nav-btn" href="{{ route('subscriptions.show', $prev) }}">◀ Vorherige</a>
            @endif
            @if ($next)
                <a class="nav-btn" href="{{ route('subscriptions.show', $next) }}">Nächste ▶</a>
            @endif
        </div>
    </div>
</div>
@endsection