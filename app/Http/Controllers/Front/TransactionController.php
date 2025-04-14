<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction()
    {
        $bookings = auth()->user()->bookings()->with('item.type', 'item.brand')->get();
        return view('transaction', compact('bookings')); // ini cocok dengan transaction.blade.php
    }
}
