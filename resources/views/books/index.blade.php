@extends('layout.app')
@section('title', 'Book Management System')
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
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1.5rem;
        padding: 2rem;
        color: white;
    }
    .glass-input {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.15) !important;
        color: white !important;
        border-radius: 0.75rem !important;
    }
    .glass-input::placeholder { color: #94a3b8 !important; }
    .glass-input option { background: #0f172a; color: white; }
    .table { color: white !important; --bs-table-bg: transparent !important; --bs-table-hover-bg: rgba(255,255,255,0.05) !important; }
    .table > :not(caption) > * > * { background-color: transparent !important; color: white !important; border-color: rgba(255,255,255,0.07) !important; }
    .table tbody tr:hover td { background-color: rgba(255,255,255,0.05) !important; }
</style>
<div class="animate-mesh">
    <div class="glass-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <div style="background:rgba(99,102,241,0.2);padding:0.75rem;border-radius:1rem;border:1px solid rgba(99,102,241,0.3);">📚</div>
                <div>
                    <h2 class="mb-0 fw-bold">Book Management System</h2>
                    <p class="mb-0" style="font-size:0.75rem;color:#818cf8;text-transform:uppercase;letter-spacing:0.1em;">Manage your collection</p>
                </div>
            </div>
            <a href="{{ route('books.create') }}" class="btn" style="background:#6366f1;color:white;border-radius:0.75rem;font-weight:600;">+ Add Book</a>
        </div>

        @if(session('success'))
            <div class="mb-3 p-3" style="background:rgba(34,197,94,0.2);border:1px solid rgba(34,197,94,0.3);color:#86efac;border-radius:0.75rem;">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-4">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control glass-input" placeholder="Search by title or author..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="genre" class="form-select glass-input">
                    <option value="">-- Filter by Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn w-100" style="background:rgba(255,255,255,0.1);color:white;border:1px solid rgba(255,255,255,0.2);border-radius:0.75rem;">Search / Filter</button>
            </div>
        </form>

        <table class="table table-borderless">
            <thead style="border-bottom:1px solid rgba(255,255,255,0.1);">
                <tr>
                    <th>Title</th><th>Author</th><th>Genre</th><th>Price</th><th>Available</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>₱{{ number_format($book->price, 2) }}</td>
                    <td>{{ $book->is_available ? '✅ Yes' : '❌ No' }}</td>
                    <td>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm" style="background:rgba(99,102,241,0.3);color:white;border-radius:0.5rem;">View</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm" style="background:rgba(234,179,8,0.3);color:white;border-radius:0.5rem;">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this book?')" class="btn btn-sm" style="background:rgba(239,68,68,0.3);color:white;border-radius:0.5rem;">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center" style="color:#94a3b8;">No books found.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $books->withQueryString()->links() }}
    </div>
</div>
@endsection