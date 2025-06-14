@extends('layouts.app')

@section('content')
<style>
.feedback-container {
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.feedback-container h2 {
    color: #ec407a;
    text-align: center;
    margin-bottom: 20px;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
}
.form-group textarea,
.form-group input[type="text"],
.form-group input[type="email"] {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
}
textarea {
    resize: vertical;
}
.submit-btn {
    background-color: #ec407a;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s;
}
.submit-btn:hover {
    background-color: #d81b60;
}
.star-rating {
    font-size: 26px;
    display: flex;
    gap: 5px;
}
.star-rating .star {
    color: #ec407a;
    cursor: pointer;
    transition: transform 0.2s;
}
.star-rating .star:hover {
    transform: scale(1.2);
}
</style>

<div class="feedback-container">
    <h2>Feedback</h2>
    <form method="POST" action="{{ route('feedback.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Dein Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Deine E-Mail</label>
            <input type="email" id="email" name="email" required>
        </div>

        <!-- Sterne-Bewertung -->
        <div class="form-group">
            <label for="rating">Wie zufrieden bist Du?</label>
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">☆</span>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="">
        </div>

        <div class="form-group">
            <label for="message">Deine Nachricht</label>
            <textarea id="message" name="message" rows="5" placeholder="Was möchtest Du uns mitteilen?" required></textarea>
        </div>

        <button type="submit" class="submit-btn">Absenden</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            ratingInput.value = rating;

            stars.forEach((s, i) => {
                s.textContent = i < rating ? '★' : '☆';
            });
        });
    });
});
</script>
@endsection