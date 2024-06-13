<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function fetchAllBooks(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $searchTerm = $request->query('search');
            $query->where('title', 'like', '%'.$searchTerm.'%')
                  ->orWhere('author', 'like', '%'.$searchTerm.'%');
        }
    
        $query->with('category');
        $books = $query->get();
    
        return response()->json(['books' => $books], 200);
    }

    public function createBook(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date_of_publication' => 'required|date',
        ]);

        $book = Book::create($validatedData);

        return response()->json(['message' => 'Book created successfully', 'data' => $book], 201);
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $user = Auth::user();
        if (!$user || $user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date_of_publication' => 'required|date',
        ]);

        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->category_id = $validatedData['category_id'];
        $book->date_of_publication = $validatedData['date_of_publication'];
        $book->save();

        return response()->json(['message' => 'Book updated successfully', 'data' => $book], 200);
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $user = Auth::user();
        if (!$user || $user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }

    public function topBooks()
    {
        $topBooks = Book::select('books.*', DB::raw('COUNT(borrowing_books.id) as borrow_count'))
            ->leftJoin('borrowing_books', 'books.id', '=', 'borrowing_books.book_id')
            ->groupBy('books.id')
            ->orderByDesc('borrow_count')
            ->limit(6)
            ->get();

        return response()->json(['data' => $topBooks]);
    }
}
