@extends('layouts.app')

@section('content')
<style>
body { font-family: 'Quicksand', sans-serif; background-color: #fef9f4; color: #3e2f21; }
.navbar { background-color: #5c3d2e; position: sticky; top: 0; z-index: 1030; }
.navbar a, .nav-link { color: white !important; font-weight: 600; }
.navbar-brand { color: white !important; font-weight: 700; font-size: 28px; text-transform: uppercase !important; }
.navbar a:hover { color: rgb(205, 208, 208) !important; }
.navbar-toggler { background-color: white; }
.dropdown-item { color: white; font-weight: bold; }
.dropdown-item:hover { color: rgb(205, 208, 208) !important; }
.dropdown-menu { background-color: #5c3d2e; }
.dropdown-toggle { text-transform: uppercase !important; }
.footer { background-color: #3e2f21; color: #fff; padding: 20px 0; }
.footer a { color: #fff; margin: 0 10px; }

.alt-card {
    background: white;
    border: 1px solid #dac4a2;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    margin-bottom: 0.7rem;
    transition: box-shadow 0.2s;
}
.alt-card:hover { box-shadow: 0 3px 12px rgba(92,61,46,0.1); }
.alt-name { font-size: 1.1rem; font-weight: 700; color: #3e2f21; }
.stars-row { color: #f59e0b; font-size: 1rem; }
.badge-count { background: #f3ece3; color: #5c3d2e; font-size: 0.75rem; padding: 2px 8px; border-radius: 999px; font-weight: 600; }
.notes-text { font-size: 0.92rem; color: #5c3d2e; font-style: italic; margin-bottom: 0.4rem; }
.review-comment { font-size: 0.9rem; color: #3e2f21; border-left: 3px solid #dac4a2; padding-left: 8px; margin: 4px 0; }
.section-title { font-size: 1.1rem; font-weight: 700; color: #5c3d2e; border-bottom: 2px solid #dac4a2; padding-bottom: 6px; margin-bottom: 0.8rem; }
.comment-input { font-size: 14px; width: 100%; padding: 0.4rem 0.6rem; border: 1px solid #dac4a2; border-radius: 6px; height: 38px; font-family: 'Quicksand', sans-serif; color: black; resize: none; }
.comment-input:focus { border-color: #5c3d2e; outline: none; box-shadow: 0 0 0 0.15rem rgba(92,61,46,0.15); }
.btn-accent { background-color: #5c3d2e; color: white; border: none; padding: 0.35rem 0.9rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.85rem; }
.btn-accent:hover { background-color: #3e2f21; color: white; }
.rate-block { font-size: 0.88rem; font-weight: 700; color: #3e2f21; margin-bottom: 2px; }
select.form-select-sm { border: 1px solid #dac4a2; border-radius: 6px; padding: 4px 8px; font-family: 'Quicksand', sans-serif; font-size: 0.88rem; }
.no-results { background: #fff7f0; border: 1px solid #dac4a2; border-radius: 10px; padding: 1.5rem; text-align: center; color: #7a5c3d; }
.search-box { border: 2px solid #dac4a2; border-radius: 8px; padding: 0.5rem 0.9rem; font-family: 'Quicksand', sans-serif; font-size: 0.95rem; color: #3e2f21; width: 100%; }
.search-box:focus { border-color: #5c3d2e; outline: none; }
</style>

<div class="container py-4" style="max-width: 780px;">

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('alternatives.search') }}" class="mb-4 d-flex gap-2">
        <input type="text" name="query" value="{{ $ingredient }}" placeholder="Search an ingredient (e.g. egg, butter, milk)..." class="search-box">
        <button type="submit" class="btn-accent px-3" style="white-space:nowrap;">Search</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger py-2">{{ session('error') }}</div>
    @endif

    @if($ingredient)
        <h5 class="fw-bold mb-3">
            Alternatives for: <span style="color:#5c3d2e;">{{ ucfirst($ingredient) }}</span>
        </h5>

        {{-- SECTION 1: Seeded / suggested alternatives --}}
        @if($seededAlternatives->isNotEmpty())
            <div class="section-title">Suggested Alternatives</div>
            @foreach($seededAlternatives as $item)
                <div class="alt-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1">
                        <span class="alt-name">{{ $item->alternative }}</span>
                    </div>
                    @if($item->notes)
                        <p class="notes-text">{{ $item->notes }}</p>
                    @endif

                    @auth
                        @php
                            $alreadyReviewed = \App\Models\AlternativeReview::where('user_id', auth()->id())
                                ->where('ingredient', $ingredient)
                                ->where('alternative', $item->alternative)
                                ->exists();
                        @endphp
                        @if(!$alreadyReviewed)
                            <form method="POST" action="{{ route('alternatives.review') }}" class="mt-2">
                                @csrf
                                <input type="hidden" name="ingredient" value="{{ $ingredient }}">
                                <input type="hidden" name="alternative" value="{{ $item->alternative }}">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div>
                                        <label class="rate-block">Rate:</label>
                                        <select name="stars" class="form-select form-select-sm">
                                            @for($i=1;$i<=5;$i++)
                                                <option value="{{ $i }}">{{ $i }} ⭐</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="rate-block">Comment (optional):</label>
                                        <input type="text" name="comment" class="search-box" style="height:34px; padding: 0.3rem 0.7rem;" placeholder="Share your experience...">
                                    </div>
                                    <div style="padding-top:18px;">
                                        <button type="submit" class="btn-accent">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p class="text-success mb-0" style="font-size:0.8rem;">You already reviewed this alternative.</p>
                        @endif
                    @else
                        <p class="mb-0" style="font-size:0.8rem; color:#7a5c3d;"><a href="{{ route('login') }}" style="color:#5c3d2e;">Login</a> to rate this alternative.</p>
                    @endauth
                </div>
            @endforeach
        @endif

        {{-- SECTION 2: Community rated alternatives --}}
        @if($scoredAlternatives->isNotEmpty())
            <div class="section-title mt-3">Community Ratings</div>
            @foreach($scoredAlternatives as $alt)
                <div class="alt-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1">
                        <span class="alt-name">{{ $alt['name'] }}</span>
                        <span class="badge-count">{{ $alt['count'] }} {{ Str::plural('review', $alt['count']) }}</span>
                    </div>
                    <div class="stars-row mb-1">
                        @for($i=1;$i<=5;$i++)
                            <span>{{ $i <= round($alt['avg_stars']) ? '★' : '☆' }}</span>
                        @endfor
                        <span class="text-muted ms-1" style="font-size:0.8rem;">{{ $alt['avg_stars'] }} / 5</span>
                    </div>

                    @foreach($alt['reviews']->take(2) as $review)
                        @if($review->comment)
                            <div class="review-comment">"{{ $review->comment }}" — <em>{{ $review->user->name ?? 'User' }}</em></div>
                        @endif
                    @endforeach

                    @auth
                        @php $alreadyReviewed = $alt['reviews']->firstWhere('user_id', auth()->id()); @endphp
                        @if(!$alreadyReviewed)
                            <form method="POST" action="{{ route('alternatives.review') }}" class="mt-2">
                                @csrf
                                <input type="hidden" name="ingredient" value="{{ $ingredient }}">
                                <input type="hidden" name="alternative" value="{{ $alt['name'] }}">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div>
                                        <label class="rate-block">Rate:</label>
                                        <select name="stars" class="form-select form-select-sm">
                                            @for($i=1;$i<=5;$i++)
                                                <option value="{{ $i }}">{{ $i }} ★</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="rate-block">Comment (optional):</label>
                                        <input type="text" name="comment" class="search-box" style="height:34px; padding: 0.3rem 0.7rem;" placeholder="Share your experience...">
                                    </div>
                                    <div style="padding-top:18px;">
                                        <button type="submit" class="btn-accent">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p class="text-success mb-0" style="font-size:0.8rem;">You already reviewed this.</p>
                        @endif
                    @endauth
                </div>
            @endforeach
        @endif

        @if($seededAlternatives->isEmpty() && $scoredAlternatives->isEmpty())
            <div class="no-results">
                <p class="mb-1">No alternatives found for <strong>{{ ucfirst($ingredient) }}</strong>.</p>
                <p class="mb-0 text-muted" style="font-size:0.85rem;">Try: egg, butter, milk, sugar, flour, cream, ghee, yogurt, oil, tomato, onion</p>
            </div>
        @endif

    @else
        <div class="no-results">
            <p class="mb-1">Search for an ingredient above to see its alternatives.</p>
            <p class="text-muted mb-0" style="font-size:0.85rem;">Try: <strong>egg</strong>, <strong>butter</strong>, <strong>milk</strong>, <strong>sugar</strong>, <strong>flour</strong>, <strong>ghee</strong></p>
        </div>
    @endif

    <div class="mt-3">
        <a href="{{ url('/') }}" class="btn-accent px-3 py-2" style="text-decoration:none; border-radius:8px;">Back to Home</a>
    </div>
</div>
@endsection