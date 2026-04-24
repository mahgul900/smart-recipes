@php
    use App\Models\AlternativeReview;

    $scoredAlternatives = collect($alternatives)->map(function ($alt) use ($ingredient) {
        $reviews = AlternativeReview::where('ingredient', $ingredient)
                    ->where('alternative', $alt)->get();
        $avg = $reviews->avg('stars') ?? 0;

        return [
            'name' => $alt,
            'avg_stars' => $avg,
            'reviews' => $reviews
        ];
    })->sortByDesc('avg_stars');
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Smart Recipes - Alternatives</title>
    <style>
        .dark {
            background-color: #121212;
            color: #fff;
        }
        .dark input, .dark textarea, .dark select, .dark button {
            background-color: #333;
            color: #fff;
            border: 1px solid #555;
        }
    </style>
</head>
<body>

    <h1>Alternatives for "{{ ucfirst($ingredient) }}"</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @foreach ($scoredAlternatives as $alt)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
            @php
                $avg = round($alt['avg_stars']);
                $avgStars = str_repeat('⭐', $avg);
            @endphp

            <h2>{{ $alt['name'] }} — {!! $avgStars !!} ({{ number_format($alt['avg_stars'], 1) }})</h2>

            <h4>Reviews:</h4>
            @forelse ($alt['reviews'] as $review)
                <p><strong>{!! str_repeat('⭐', $review->stars) !!}</strong> - {{ $review->comment }}</p>
            @empty
                <p>No reviews yet.</p>
            @endforelse

            @auth
                @php
                    $alreadyReviewed = $alt['reviews']->firstWhere('user_id', auth()->id());
                @endphp

                @if ($alreadyReviewed)
                    <p style="color: gray;">✅ You've already reviewed this alternative.</p>
                @else
                    <form method="POST" action="{{ route('alternatives.review') }}">
                        @csrf
                        <input type="hidden" name="ingredient" value="{{ $ingredient }}">
                        <input type="hidden" name="alternative" value="{{ $alt['name'] }}">

                        <label>Rate this alternative:</label>
                        <select name="stars" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select><br><br>

                        <label>Your Review:</label><br>
                        <textarea name="comment" rows="2" style="width: 100%;"></textarea><br><br>

                        <button type="submit">Submit Review</button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach

    <a href="{{ url('/') }}">🔙 Back to Home</a>

</body>
</html>
