<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BorrowingBook;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function borrow(Request $request, Book $book)
    {
        $user = Auth::user();

        // Create a borrowing record
        $borrowing = new BorrowingBook();
        $borrowing->user_id = $user->id;
        $borrowing->book_id = $book->id;
        $borrowing->date_borrowed = now();
        $borrowing->due_date = now()->addDays(14); 
        $borrowing->save();

        return response()->json(['message' => 'Book borrowed successfully'], 200);
    }
}
