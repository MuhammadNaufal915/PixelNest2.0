@extends('layouts.app')
@section('title', $artwork->title)
@section('styles')
<style>
.detail-container{display:grid;grid-template-columns:2fr 1fr;gap:3rem;margin-top:2rem}
.artwork-image{width:100%;border-radius:1rem;box-shadow:0 20px 60px rgba(0,0,0,0.15)}
.artwork-info{background:#fff;padding:2rem;border-radius:1rem;height:fit-content}
.price-tag{font-size:2rem;font-weight:800;color:var(--primary);margin:1rem 0}
.info-section{margin:2rem 0;padding:2rem 0;border-top:1px solid var(--gray-light)}
.related-title{font-size:2rem;margin:4rem 0 2rem}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:2rem}
.card{background:#fff;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.1);transition:all 0.3s}
.card:hover{transform:translateY(-5px)}
.card-img{width:100%;height:200px;object-fit:cover}
.card-body{padding:1rem}
/* Star Rating Styles */
.rating-display{display:flex;align-items:center;gap:0.5rem;margin:1rem 0}
.stars{display:flex;gap:0.2rem;font-size:1.5rem}
.star{color:#fbbf24}
.star.empty{color:#d1d5db}
.rating-text{color:var(--gray);font-size:0.9rem}
/* Review Form */
.review-form{background:#f8fafc;padding:2rem;border-radius:0.8rem;margin-top:2rem}
.star-input{display:flex;gap:0.3rem;font-size:2rem;cursor:pointer;margin:1rem 0}
.star-input .star{color:#d1d5db;transition:all 0.2s}
.star-input .star.active,.star-input .star:hover{color:#fbbf24}
.form-group{margin:1.5rem 0}
.form-group label{display:block;margin-bottom:0.5rem;font-weight:600}
.form-control{width:100%;padding:0.8rem;border:2px solid var(--gray-light);border-radius:0.5rem;font-family:inherit;font-size:1rem}
.form-control:focus{outline:none;border-color:var(--primary)}
/* Reviews List */
.reviews-section{margin-top:4rem}
.review-item{background:#fff;padding:1.5rem;border-radius:0.8rem;margin-bottom:1rem;box-shadow:0 2px 4px rgba(0,0,0,0.05)}
.review-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:0.8rem}
.reviewer-name{font-weight:600}
.review-date{color:var(--gray);font-size:0.85rem}
.review-comment{color:var(--dark);line-height:1.6;margin-top:0.5rem}
.no-reviews{text-align:center;padding:3rem;color:var(--gray)}
</style>
@endsection
@section('content')
<div class="detail-container">
    <div><img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="artwork-image"></div>
    <div class="artwork-info">
        <span style="color:var(--gray);font-size:0.9rem">{{ $artwork->category->name }}</span>
        <h1>{{ $artwork->title }}</h1>
        <p style="color:var(--gray);margin:1rem 0">by {{ $artwork->user->name }}</p>
        
        @if($artwork->reviews_count > 0)
            <div class="rating-display">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($artwork->average_rating))
                            <span class="star">★</span>
                        @else
                            <span class="star empty">☆</span>
                        @endif
                    @endfor
                </div>
                <span class="rating-text">{{ number_format($artwork->average_rating, 1) }} ({{ $artwork->reviews_count }} {{ $artwork->reviews_count == 1 ? 'review' : 'reviews' }})</span>
            </div>
        @endif
        
        <div class="price-tag">Rp {{ number_format($artwork->price, 0, ',', '.') }}</div>
        @auth
            @if(auth()->id() !== $artwork->user_id)
                <form method="POST" action="{{ route('cart.add', $artwork) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width:100%;padding:1rem">Add to Cart</button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;padding:1rem;text-align:center;display:block">Login to Purchase</a>
        @endauth
        <div class="info-section">
            <h3>Description</h3>
            <p style="color:var(--gray);line-height:1.8">{{ $artwork->description }}</p>
        </div>
        <div style="color:var(--gray);font-size:0.9rem">Downloads: {{ $artwork->downloads_count }}</div>
    </div>
</div>

<!-- Reviews Section -->
<div class="reviews-section">
    <h2>Reviews {{ $artwork->reviews_count > 0 ? '(' . $artwork->reviews_count . ')' : '' }}</h2>
    
    @if($userCanReview)
        <div class="review-form">
            <h3>Tulis Review Anda</h3>
            <form method="POST" action="{{ route('reviews.store', $artwork) }}" id="reviewForm">
                @csrf
                <div class="form-group">
                    <label>Rating *</label>
                    <div class="star-input" id="starRating">
                        <span class="star" data-value="1">☆</span>
                        <span class="star" data-value="2">☆</span>
                        <span class="star" data-value="3">☆</span>
                        <span class="star" data-value="4">☆</span>
                        <span class="star" data-value="5">☆</span>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" required>
                </div>
                
                <div class="form-group">
                    <label>Komentar (opsional)</label>
                    <textarea name="comment" class="form-control" rows="4" maxlength="1000" placeholder="Bagikan pengalaman Anda dengan artwork ini..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    @elseif($userReview)
        <div class="review-item" style="border:2px solid var(--primary)">
            <div class="review-header">
                <div>
                    <div class="reviewer-name">Review Anda</div>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $userReview->rating)
                                <span class="star">★</span>
                            @else
                                <span class="star empty">☆</span>
                            @endif
                        @endfor
                    </div>
                </div>
                <span class="review-date">{{ $userReview->created_at->diffForHumans() }}</span>
            </div>
            @if($userReview->comment)
                <p class="review-comment">{{ $userReview->comment }}</p>
            @endif
        </div>
    @endif
    
    @if($artwork->reviews_count > 0)
        @foreach($artwork->reviews as $review)
            @if(!$userReview || $review->id !== $userReview->id)
                <div class="review-item">
                    <div class="review-header">
                        <div>
                            <div class="reviewer-name">{{ $review->user->name }}</div>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <span class="star">★</span>
                                    @else
                                        <span class="star empty">☆</span>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    @if($review->comment)
                        <p class="review-comment">{{ $review->comment }}</p>
                    @endif
                </div>
            @endif
        @endforeach
    @elseif(!$userCanReview && !$userReview)
        <div class="no-reviews">
            <p>Belum ada review untuk artwork ini.</p>
            @guest
                <p><a href="{{ route('login') }}" style="color:var(--primary)">Login</a> dan beli artwork ini untuk memberikan review pertama!</p>
            @endguest
        </div>
    @endif
</div>

<h2 class="related-title">Related Artworks</h2>
<div class="grid">
    @foreach($relatedArtworks as $item)
        <a href="{{ route('artworks.show', $item) }}" style="text-decoration:none;color:inherit">
            <div class="card">
                <img src="{{ $item->image_url }}" class="card-img">
                <div class="card-body">
                    <h4>{{ $item->title }}</h4>
                    @if($item->reviews_count > 0)
                        <div class="stars" style="font-size:0.9rem;margin:0.3rem 0">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($item->average_rating))
                                    <span class="star">★</span>
                                @else
                                    <span class="star empty">☆</span>
                                @endif
                            @endfor
                            <span style="color:var(--gray);font-size:0.8rem;margin-left:0.3rem">({{ $item->reviews_count }})</span>
                        </div>
                    @endif
                    <p style="color:var(--primary);font-weight:700">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const starRating = document.getElementById('starRating');
    if (starRating) {
        const stars = starRating.querySelectorAll('.star');
        const ratingInput = document.getElementById('ratingInput');
        
        stars.forEach((star, index) => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;
                
                stars.forEach((s, i) => {
                    if (i < value) {
                        s.classList.add('active');
                        s.textContent = '★';
                    } else {
                        s.classList.remove('active');
                        s.textContent = '☆';
                    }
                });
            });
            
            star.addEventListener('mouseenter', function() {
                const value = this.getAttribute('data-value');
                stars.forEach((s, i) => {
                    if (i < value) {
                        s.textContent = '★';
                    } else {
                        s.textContent = '☆';
                    }
                });
            });
        });
        
        starRating.addEventListener('mouseleave', function() {
            const currentValue = ratingInput.value;
            stars.forEach((s, i) => {
                if (i < currentValue) {
                    s.textContent = '★';
                } else {
                    s.textContent = '☆';
                }
            });
        });
    }
});
</script>
@endsection
