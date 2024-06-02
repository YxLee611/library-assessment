<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function fetchAllBooks()
    {
        $books = Book::with('category')->get();

        return response()->json(['books' => $books], 200);
    }
}
