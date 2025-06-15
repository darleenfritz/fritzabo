@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
    $subs = \App\Models\Subscription::all();
    $activeCount = $subs->where('subscription_end', '>=', now())->count();
    $expiredCount = $subs->where('subscription_end', '<', now())->count();
    $avgPrice = $subs->avg('price');
@endphp

<style>
.profile-card {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    align-items: center;
}
.profile-avatar {
    flex: 0 0 150px;
    height: 150px;
    border-radius: 50%;
    background: #ec407a;
    color: white;
    font-size: 42px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    text-transform: uppercase;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
.profile-details {
    flex: 1;
}
.profile-details h2 {
    color: #ec407a;
    margin-bottom: 10px;
}
.profile-details p {
    margin: 6px 0;
}
.profile-section {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background: #fafafa;
    border: 1px solid #eee;
    border-radius: 10px;
}
.profile-section h3 {
    color: #ec407a;
    margin-bottom: 10px;
}
.stat-box {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
.stat-item {
    flex: 1;
    min-width: 160px;
    background: white;
    padding: 14px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}
.stat-item strong {
    display: block;
    font-size: 20px;
    color: #ec407a;
}
</style>

<div class="profile-card">
    <div class="profile-avatar">
        DF
    </div>
    <div class="profile-details">
        <h2>Darleen Fritz</h2>
        <p><strong>E-Mail:</strong> darleen.fritz@fritzabo.de</p>
        <p><strong>Kundennummer:</strong> #10001</p>
        <p><strong>Kunde seit:</strong> Januar 2024</p>
    </div>
</div>
<div style="text-align: center; margin-top: 30px;">
    <a href="#" style="background-color: #ec407a; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">
        Profil bearbeiten
    </a>
</div>
<div class="profile-section">
    <h3>Deine Abo-Statistik</h3>
    <div class="stat-box">
        <div class="stat-item">
            <strong>{{ $activeCount }}</strong>
            Aktive Abos
        </div>
        <div class="stat-item">
            <strong>{{ $expiredCount }}</strong>
            Abgelaufen
        </div>
        <div class="stat-item">
            <strong>{{ number_format($avgPrice, 2, ',', '.') }} €</strong>
            Ø Preis
        </div>
    </div>
</div>


<div class="profile-section">
    <h3>Letzten Aktivitäten</h3>
    <ul style="padding-left: 20px;">
        ✅ Abo „FAZ Digital“ abgeschlossen (03. Juni 2025)<br>
        ❌ Abo „Netflix“ gekündigt (25. Mai 2025)<br>
        ✅ Medientyp „Streaming“ bewertet (22. Mai 2025)<br>
    </ul>
</div>


<div class="profile-section">
    <h3>Kontakt zum Support</h3>
    <p>Du hast Fragen zu Deinem Kundenkonto oder Deinen Abos? Unser Support-Team hilft Dir gerne weiter:</p>
    <p><strong>E-Mail:</strong><br>
    <a href="mailto:support@fritzabo.de" style="color: #ec407a;">support@fritzabo.de</a></p>
    <p><strong>Telefon:</strong><br>+49 931 123456</p>
    <p style="margin-top: 15px;">
        👉 <a href="{{ route('kontakt') }}" style="color: #ec407a; font-weight: bold;">Zur Kontaktseite</a>
    </p>
</div>
@endsection