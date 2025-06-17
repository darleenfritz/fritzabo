@extends('layouts.app')

@section('content')

<div style="max-width: 1000px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start; padding: 30px;">

    <!-- Kontakttext -->
    <div style="flex: 1; min-width: 280px;">
        <h2 style="color:#ec407a;">Kontakt</h2>

        <p>Du hast Fragen zu Deinem Abo, möchtest ein Problem melden oder uns Feedback geben?<br>
        Wir sind gerne für Dich da!</p>

        <h4 style="margin-top: 20px;">So erreichst Du uns:</h4>
        <ul style="list-style: none; padding-left: 0;">
            <li style="margin-bottom: 10px;"><strong>E-Mail:</strong> <a href="mailto:support@fritzabo.de" style="color: #ec407a;">support@fritzabo.de</a></li>
            <li style="margin-bottom: 10px;"><strong>Telefon:</strong> +49 931 123456</li>
            <li style="margin-bottom: 10px;"><strong>Servicezeiten:</strong> Montag bis Freitag, 9:00–17:00 Uhr</li>
        </ul>


        <p style="margin-top: 20px;">Oder nutze einfach den Chat mit <strong>Fritzi</strong> – unserem kleinen Helfer rechts!</p>
    </div>

    <!-- Chatbot -->
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
        botResponse = 'Du kannst Deine Mitgliedschaft bei FritzAbo jederzeit per E-Mail kündigen.';
    } else if (lower.includes('preis')) {
        botResponse = 'Die Preise findest Du auf der Übersichtsseite der Abonnements.';
    } else if (lower.includes('kontakt')) {
        botResponse = 'Du erreichst uns unter support@fritzabo.de oder telefonisch.';
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