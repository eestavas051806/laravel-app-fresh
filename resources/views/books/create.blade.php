@extends('layout.app')
@section('title', 'Add Book')
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
    .glass-input {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.15) !important;
        color: white !important;
        border-radius: 0.75rem !important;
    }
    .glass-input::placeholder { color: #94a3b8 !important; }
    .glass-input option { background: #0f172a; color: white; }
    label { color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }
    .form-check-label { color: white !important; text-transform: none !important; font-size: 0.9rem !important; }
</style>
<div class="animate-mesh">
    <div class="glass-card">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div style="background:rgba(99,102,241,0.2);padding:0.75rem;border-radius:1rem;border:1px solid rgba(99,102,241,0.3);">📖</div>
            <div>
                <h2 class="mb-0 fw-bold">Add New Book</h2>
                <p class="mb-0" style="font-size:0.75rem;color:#818cf8;text-transform:uppercase;letter-spacing:0.1em;">Fill in the details below</p>
            </div>
        </div>

        <a href="{{ route('books.index') }}" class="btn btn-sm mb-4" style="background:rgba(255,255,255,0.1);color:white;border-radius:0.75rem;">← Back</a>

        @if($errors->any())
            <div class="mb-3 p-3" style="background:rgba(239,68,68,0.2);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;border-radius:0.75rem;">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control glass-input" value="{{ old('title') }}">
                </div>
                <div class="col-md-6">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control glass-input" value="{{ old('author') }}">
                </div>
                <div class="col-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control glass-input" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label>Genre</label>
                    <select name="genre" class="form-select glass-input">
                        <option value="">-- Select Genre --</option>
                        @foreach(['Fiction','Non-Fiction','Sci-Fi','Fantasy','Mystery','Romance','Horror','Biography','History','Self-Help'] as $g)
                            <option value="{{ $g }}" {{ old('genre') == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Published Year</label>
                    <input type="number" name="published_year" class="form-control glass-input" value="{{ old('published_year') }}">
                </div>
                <div class="col-md-6">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control glass-input" value="{{ old('isbn') }}">
                </div>
                <div class="col-md-6">
                    <label>Pages</label>
                    <input type="number" name="pages" class="form-control glass-input" value="{{ old('pages') }}">
                </div>
                <div class="col-md-6">
                    <label>Language</label>
                    <input type="text" name="language" class="form-control glass-input" value="{{ old('language') }}">
                </div>
                <div class="col-md-6">
                    <label>Publisher</label>
                    <input type="text" name="publisher" class="form-control glass-input" value="{{ old('publisher') }}">
                </div>
                <div class="col-md-6">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control glass-input" value="{{ old('price') }}">
                </div>
                <div class="col-12">
                    <label>Cover Image</label>
                    <input type="file" name="cover_image" class="form-control glass-input">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_available" class="form-check-input" id="is_available" checked>
                        <label class="form-check-label" for="is_available">Available</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn w-100" style="background:#6366f1;color:white;border-radius:0.75rem;font-weight:600;padding:0.75rem;">Save Book</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection