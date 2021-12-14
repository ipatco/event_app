<?php

namespace App\Http\Controllers\Vendor;

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
        $service = Service::where('user_id', auth()->user()->id)->count();
        $event = Event::where('user_id', auth()->user()->id)->count();
        $upcoming = Event::where('user_id', auth()->user()->id)->where('end_date', '>', now())->count();
        $earning = Transaction::where('user_id', auth()->user()->id)->sum('payment_amount');
        $thisMonth = Carbon::now()->startOfMonth()->format('m');
        $numOfDays = Carbon::now()->daysInMonth;
        for ($i = 1; $i <= $numOfDays; $i++) {
            $day = Carbon::now()->startOfMonth()->addDays($i - 1)->format('d');
            $dayEarning = Transaction::where('user_id', auth()->user()->id)->whereDay('created_at', $day)->whereMonth('created_at', $thisMonth)->get();
            $dayEarning = $dayEarning->sum('payment_amount');
            $monthEarning[$i] = $dayEarning;
        }
        return view('vendor.dashboard', compact('service', 'event', 'upcoming', 'earning', 'monthEarning', 'thisMonth', 'numOfDays'));
    }
}
