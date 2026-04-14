@extends('layout.app')
@section('title', $book->title)
@section('content')
<style>
    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-mesh {
        background: linear-gradient(-45deg, #1cb845, #07cc77, #d3bc0b, #020617);
        background-size: 400% 400%;
        animation: gradientFlow 10s ease infinite;
        min-height: 100vh;
        padding: 2rem;
    }
    .glass-card {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 1.5rem;
        padding: 2rem;
        color: white;
        max-width: 700px;
        margin: 0 auto;
    }
    .detail-row {
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: 0.6rem 0;
        display: flex;
        gap: 1rem;
    }
    .detail-label {
        color: #818cf8;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        min-width: 130px;
    }
</style>
<div class="animate-mesh">
    <div class="glass-card">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div style="background:rgba(99,102,241,0.2);padding:0.75rem;border-radius:1rem;border:1px solid rgba(99,102,241,0.3);">📗</div>
            <div>
                <h2 class="mb-0 fw-bold">{{ $book->title }}</h2>
                <p class="mb-0" style="font-size:0.75rem;color:#818cf8;text-transform:uppercase;letter-spacing:0.1em;">Book Details</p>
            </div>
        </div>

        <a href="{{ route('books.index') }}" class="btn btn-sm mb-4" style="background:rgba(255,255,255,0.1);color:white;border-radius:0.75rem;">← Back</a>

        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" class="d-block mb-4" style="max-height:200px;border-radius:1rem;">
        @endif

        <div class="detail-row"><span class="detail-label">Author</span><span>{{ $book->author }}</span></div>
        <div class="detail-row"><span class="detail-label">Genre</span><span>{{ $book->genre }}</span></div>
        <div class="detail-row"><span class="detail-label">Description</span><span>{{ $book->description }}</span></div>
        <div class="detail-row"><span class="detail-label">Published Year</span><span>{{ $book->published_year }}</span></div>
        <div class="detail-row"><span class="detail-label">ISBN</span><span>{{ $book->isbn }}</span></div>
        <div class="detail-row"><span class="detail-label">Pages</span><span>{{ $book->pages }}</span></div>
        <div class="detail-row"><span class="detail-label">Language</span><span>{{ $book->language }}</span></div>
        <div class="detail-row"><span class="detail-label">Publisher</span><span>{{ $book->publisher }}</span></div>
        <div class="detail-row"><span class="detail-label">Price</span><span>₱{{ number_format($book->price, 2) }}</span></div>
        <div class="detail-row"><span class="detail-label">Available</span><span>{{ $book->is_available ? '✅ Yes' : '❌ No' }}</span></div>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('books.edit', $book) }}" class="btn" style="background:rgba(234,179,8,0.3);color:white;border-radius:0.75rem;">✏️ Edit</a>
            <form action="{{ route('books.destroy', $book) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this book?')" class="btn" style="background:rgba(239,68,68,0.3);color:white;border-radius:0.75rem;">🗑️ Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection