@extends('layouts.app')

@section('content')
<style>
.hero {
    background: linear-gradient(to right, #f48fb1, #ce93d8);
    padding: 80px 30px;
    text-align: center;
    color: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    margin-bottom: 50px;
}
.hero h1 {
    font-size: 46px;
    font-weight: 700;
    margin-bottom: 20px;
}
.hero p {
    font-size: 20px;
    max-width: 800px;
    margin: 0 auto;
    opacity: 0.95;
}

.features {
    max-width: 1100px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    margin-bottom: 50px;
    padding: 0 20px;
}
.feature-box {
    background: white;
    border-radius: 16px;
    padding: 30px 20px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    flex: 1 1 300px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.feature-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
}
.feature-box h3 {
    color: #ec407a;
    font-size: 22px;
    margin-top: 10px;
    margin-bottom: 10px;
}
.feature-box p {
    font-size: 15px;
    color: #555;
    line-height: 1.5;
}
.feature-icon {
    font-size: 38px;
    margin-bottom: 10px;
    color: #ec407a;
}

.start-actions {
    text-align: center;
    margin-top: 30px;
}
.start-actions a {
    background-color: #ec407a;
    color: white;
    text-decoration: none;
    padding: 14px 28px;
    margin: 10px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
    display: inline-block;
    transition: background-color 0.3s ease;
}
.start-actions a:hover {
    background-color: #d81b60;
}

/* Fancy Carousel */
.fancy-carousel {
    max-width: 800px;
    margin: 60px auto 80px auto;
    text-align: center;
    position: relative;
}
.fancy-slide {
    display: none;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
}
.fancy-slide.active {
    display: block;
    opacity: 1;
    position: relative;
}
.fancy-slide p {
    font-size: 18px;
    font-style: italic;
    color: #555;
    margin-bottom: 10px;
}
.fancy-slide strong {
    color: #ec407a;
    font-weight: bold;
}
.carousel-dots {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 10px;
}
.carousel-dot {
    width: 12px;
    height: 12px;
    background: #ddd;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s ease;
}
.carousel-dot.active {
    background: #ec407a;
}
</style>

<div class="hero">
    <h1>Willkommen bei <span style="font-family: 'Pacifico', cursive; color: #ec407a;">FritzAbo</span></h1>
    <p>Dein persönlicher Abo-Manager: Abos organisieren, Fristen im Blick behalten, alles zentral verwalten – einfacher geht’s nicht!</p>
</div>

<div class="features">
    <div class="feature-box">
        <div class="feature-icon">📊</div>
        <h3>Alle Abos im Griff</h3>
        <p>Verwalte all Deine Abonnements zentral – egal ob digital, print oder streaming.</p>
    </div>
    <div class="feature-box">
        <div class="feature-icon">⏰</div>
        <h3>Nie mehr vergessen</h3>
        <p>Automatische Erinnerungen vor Ablauf – keine unnötigen Verlängerungen mehr.</p>
    </div>
    <div class="feature-box">
        <div class="feature-icon">⚙️</div>
        <h3>Mit einem Klick</h3>
        <p>Bearbeiten, verlängern oder kündigen – alles mit wenigen Klicks erledigt.</p>
    </div>
</div>

{{-- Fancy Testimonials --}}
<div class="fancy-carousel">
    <div class="fancy-slide active">
        <p>„FritzAbo hat meine Abo-Chaos endlich aufgeräumt – super einfach!“</p>
        <strong>– Julia M.</strong>
    </div>
    <div class="fancy-slide">
        <p>„Endlich keine vergessenen Kündigungen mehr. Danke!“</p>
        <strong>– Tobias R.</strong>
    </div>
    <div class="fancy-slide">
        <p>„Mega übersichtlich! Und die Verlängerungsfunktion ist top.“</p>
        <strong>– Aylin K.</strong>
    </div>
    <div class="carousel-dots">
        <div class="carousel-dot active" onclick="goToSlide(0)"></div>
        <div class="carousel-dot" onclick="goToSlide(1)"></div>
        <div class="carousel-dot" onclick="goToSlide(2)"></div>
    </div>
</div>

<script>
let currentFancy = 0;
const slides = document.querySelectorAll('.fancy-slide');
const dots = document.querySelectorAll('.carousel-dot');

function showFancySlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        dots[i].classList.remove('active');
    });
    slides[index].classList.add('active');
    dots[index].classList.add('active');
    currentFancy = index;
}

function nextFancySlide() {
    currentFancy = (currentFancy + 1) % slides.length;
    showFancySlide(currentFancy);
}

function goToSlide(index) {
    showFancySlide(index);
}

setInterval(nextFancySlide, 6000);
</script>

<div style="max-width: 1000px; margin: 80px auto 60px auto; background: #fef5f9; border-radius: 20px; padding: 40px 30px; box-shadow: 0 4px 16px rgba(0,0,0,0.06); text-align: center;">
    <h2 style="color: #ec407a; margin-bottom: 20px;">Jetzt loslegen</h2>
    <p style="font-size: 16px; color: #555; max-width: 700px; margin: 0 auto 30px;">
        Du bist nur einen Klick davon entfernt, Deine Abos im Griff zu haben:
    </p>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <a href="{{ route('subscriptions.index') }}" style="flex: 1 1 240px; background: white; border-radius: 14px; padding: 24px; text-decoration: none; color: #ec407a; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <div style="font-size: 32px; margin-bottom: 10px;">📋</div>
            <div style="font-weight: bold; font-size: 16px;">Meine Abos</div>
            <div style="font-size: 13px; color: #666; margin-top: 6px;">Verwalte Deine Abonnements</div>
        </a>

        <a href="{{ route('mediatypes.index') }}" style="flex: 1 1 240px; background: white; border-radius: 14px; padding: 24px; text-decoration: none; color: #ba68c8; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <div style="font-size: 32px; margin-bottom: 10px;">📚</div>
            <div style="font-weight: bold; font-size: 16px;">Medientypen</div>
            <div style="font-size: 13px; color: #666; margin-top: 6px;">Entdecke die Kategorien</div>
        </a>

        <a href="{{ route('feedback.create') }}" style="flex: 1 1 240px; background: white; border-radius: 14px; padding: 24px; text-decoration: none; color: #90caf9; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <div style="font-size: 32px; margin-bottom: 10px;">⭐</div>
            <div style="font-weight: bold; font-size: 16px;">Feedback</div>
            <div style="font-size: 13px; color: #666; margin-top: 6px;">Sag uns, was Dir gefällt oder fehlt</div>
        </a>
    </div>

</div>
<div style="max-width: 700px; margin: 60px auto; background: #f9f9f9; padding: 30px; border-radius: 16px; text-align: center;">
    <h3 style="color: #ec407a;">Bleib auf dem Laufenden</h3>
    <p style="font-size: 15px; color: #555;">Verpasse keine neuen Features oder Verbesserungen mehr.</p>
    <input type="email" placeholder="E-Mail-Adresse" style="padding: 10px; width: 60%; border-radius: 8px; border: 1px solid #ccc; margin-top: 10px;">
    <br>
    <button style="margin-top: 10px; background-color: #ec407a; color: white; padding: 10px 20px; border: none; border-radius: 8px;">Jetzt anmelden</button>
</div>
@endsection