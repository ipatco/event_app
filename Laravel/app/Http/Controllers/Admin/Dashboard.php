<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $monthEarning = [];
        $service = Service::count();
        $event = Event::count();
        $upcoming = Event::where('end_date', '>', now())->count();
        $earning = Transaction::sum('payment_amount');
        $thisMonth = Carbon::now()->startOfMonth()->format('m');
        $numOfDays = Carbon::now()->daysInMonth;
        for ($i = 1; $i <= $numOfDays; $i++) {
            $day = Carbon::now()->startOfMonth()->addDays($i - 1)->format('d');
            $dayEarning = Transaction::whereDay('created_at', $day)->whereMonth('created_at', $thisMonth)->get();
            $dayEarning = $dayEarning->sum('payment_amount');
            $monthEarning[$i] = $dayEarning;
        }
        return view('admin.dashboard', compact('service', 'event', 'upcoming', 'earning', 'monthEarning', 'numOfDays', 'thisMonth'));
    }
}
