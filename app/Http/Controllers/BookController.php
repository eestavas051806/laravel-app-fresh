<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        $books = $query->latest()->paginate(10);
        $genres = Book::select('genre')->distinct()->pluck('genre');

        return view('books.index', compact('books', 'genres'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'description'    => 'required',
            'genre'          => 'required',
            'published_year' => 'required|integer',
            'isbn'           => 'required|unique:books,isbn',
            'pages'          => 'required|integer',
            'language'       => 'required',
            'publisher'      => 'required',
            'price'          => 'required|numeric',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'description'    => 'required',
            'genre'          => 'required',
            'published_year' => 'required|integer',
            'isbn'           => 'required|unique:books,isbn,' . $book->id,
            'pages'          => 'required|integer',
            'language'       => 'required',
            'publisher'      => 'required',
            'price'          => 'required|numeric',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}