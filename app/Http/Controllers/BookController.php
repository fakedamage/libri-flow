<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->get('title') . '%');
        }

        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->get('author') . '%');
        }

        $perPage = $request->get('per_page', 10);
        $books = $query->paginate($perPage);

        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'isbn' => 'required|string|unique:books',
            'available_quantity' => 'required|integer|min:1',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string',
            'author' => 'string',
            'description' => 'string',
            'isbn' => 'string|unique:books,isbn,' . $id,
            'available_quantity' => 'integer|min:0',
        ]);

        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->all());

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }

    public function reserve($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        if ($book->available_quantity > 0) {
            $book->available_quantity -= 1;
            $book->save();

            return response()->json(['message' => 'Book reserved successfully', 'book' => $book]);
        }

        return response()->json(['message' => 'No available copies to reserve'], 400);
    }
}
