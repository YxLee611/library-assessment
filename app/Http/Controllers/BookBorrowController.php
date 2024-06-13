<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BorrowingBook;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function borrow(Request $request, Book $book)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $bookId = $request->input('book_id');
        $userId = Auth::id();

        $existingBorrow = BorrowingBook::where('book_id', $bookId)
                                        ->where('user_id', $userId)
                                        ->first();
        
        if ($existingBorrow) {
            return response()->json(['message' => 'Book already borrowed'], 400);
        }

        $borrowing = new BorrowingBook();
        $borrowing->user_id = $userId;
        $borrowing->book_id = $bookId;
        $borrowing->date_borrowed = Carbon::now();
        $borrowing->due_date = Carbon::now()->addDays(14);
        $borrowing->save();

        return response()->json(['message' => 'Book borrowed successfully', 'data' => $borrowing], 201);
    }

    public function borrowedBooksList(Request $request)
    {
        $userId = Auth::id();

        $borrowedBooks = BorrowingBook::with('book')
                            ->where('user_id', $userId)
                            ->get();

        return response()->json(['data' => $borrowedBooks], 200);
    }
}
