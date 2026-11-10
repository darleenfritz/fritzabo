@extends('layouts.app')

@section('content')

<div style="max-width: 1000px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start; padding: 30px;">

    <div style="flex: 1; min-width: 280px;">
        <h2 style="color:#ec407a;">Kontakt</h2>

        <p>Du hast Fragen zu Deinem Abo, möchtest ein Problem melden oder uns Feedback geben?<br>
        Wir sind gerne für Dich da!</p>

        <p style="margin-top: 20px;"><em>Hinweis: FritzAbo ist ein Studienprojekt. In einer veröffentlichten Anwendung stünden hier E-Mail-Adresse, Telefonnummer und Servicezeiten.</em></p>

        <p style="margin-top: 20px;">Oder nutze einfach den Chat mit <strong>Fritzi</strong> – unserem kleinen Helfer rechts!</p>
    </div>

    <div style="flex: 0 0 360px; min-width: 300px; border: 1px solid #ddd; border-radius: 10px; padding: 20px; background: #fafafa;">
        <h3 style="color: #ec407a;">Fritzi – Dein Helfer</h3>
        <div id="chat-log" style="height: 240px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 6px; background: white; font-size: 14px;"></div>
        <div style="display: flex; gap: 8px; margin-top: 10px;">
            <input type="text" id="chat-input" placeholder="Frage etwas..." style="flex: 1; padding: 6px; border-radius: 6px; border: 1px solid #ccc; font-size: 14px;">
            <button onclick="handleChat()" style="background-color: #ec407a; color: white; border: none; padding: 6px 14px; border-radius: 6px; font-size: 14px;">Senden</button>
        </div>
    </div>

</div>

<script>
function handleChat() {
    const input = document.getElementById('chat-input');
    const log = document.getElementById('chat-log');
    const userMessage = input.value.trim();
    if (!userMessage) return;

    log.innerHTML += `<div><strong>Du:</strong> ${userMessage}</div>`;

    let botResponse = 'Das habe ich leider nicht verstanden.';
    const lower = userMessage.toLowerCase();

    if (lower.includes('kündigen')) {
        botResponse = 'Ein Abo kannst Du in der Übersicht beenden.';
    } else if (lower.includes('preis')) {
        botResponse = 'Die Preise findest Du auf der Übersichtsseite der Abonnements.';
    } else if (lower.includes('kontakt')) {
        botResponse = 'Alle Kontaktmöglichkeiten findest Du links auf dieser Seite.';
    } else if (lower.includes('hilfe')) {
        botResponse = 'Ich helfe Dir gerne! Frag mich nach Preisen, Kündigung oder Support.';
    } else if (lower.includes('danke')) {
        botResponse = 'Gerne! Bis zum nächsten Mal.';
    }
    

    setTimeout(() => {
        log.innerHTML += `<div><strong>Fritzi:</strong> ${botResponse}</div>`;
        log.scrollTop = log.scrollHeight;
    }, 400);

    input.value = '';
}
</script>

@endsection