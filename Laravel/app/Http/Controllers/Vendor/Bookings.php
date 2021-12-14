<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Booking;
use Illuminate\Http\Request;

class Bookings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $bookings = Booking::with(['event'])->where('vendor_id', '=', auth()->user()->id)->orderBy('id', 'desc')->get();
        // dd($bookings);
        return view('vendor.bookings.manage', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::with(['event.category', 'user', 'vendor'])->where('vendor_id', '=', auth()->user()->id)->find($id);
        // dd($booking);
        return view('vendor.bookings.edit', compact('booking'));
    }
}
