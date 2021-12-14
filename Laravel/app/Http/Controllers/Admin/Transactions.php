<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class Transactions extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user'])->orderBy('id', 'desc')->get();
        return view('admin.transactions', compact('transactions'));
    }
}
