<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\BorrowingBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function getStatistics()
    {
        $user = Auth::user();

        if (!$user || $user->role_id !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalBorrowedBooks = BorrowingBook::count();

        return response()->json([
            'total_users' => $totalUsers,
            'total_books' => $totalBooks,
            'total_borrowed_books' => $totalBorrowedBooks,
        ]);
    }
}
