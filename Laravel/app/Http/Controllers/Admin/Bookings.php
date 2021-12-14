<?php

namespace App\Http\Controllers\Admin;

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
        $bookings = Booking::with(['event', 'service', 'transaction'])->orderBy('id', 'desc')->get();
        // dd($bookings);
        return view('admin.bookings.manage', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.bookings.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:bookings',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'category' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'organizer_name' => 'required|string|max:255',
            'organizer_phone' => 'required|numeric',
            'organizer_email' => 'required|email',
            'organizer_website' => 'required|url',
            'status' => 'required|numeric',
        ]);

        $booking = new Booking();
        $booking->title = $request->title;
        $booking->slug = $request->slug;
        $booking->description = $request->description;
        $booking->location = $request->location;
        $booking->price = $request->price;
        $booking->category_id = $request->category;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->o_name = $request->organizer_name;
        $booking->o_phone = $request->organizer_phone;
        $booking->o_email = $request->organizer_email;
        $booking->o_website = $request->organizer_website;
        $booking->user_id = '1'; //auth()->user()->id;
        $booking->status = $request->status;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bookings'), $imageName);
            $booking->image = $imageName;
        }
        $booking->save();
        return redirect()->route('admin.bookings')->with('success', 'Event Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::with(['event.category', 'user', 'vendor', 'service', 'transaction'])->find($id);
        // dd($booking);
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'organizer_name' => 'required|string|max:255',
            'organizer_phone' => 'required|numeric',
            'organizer_email' => 'required|email',
            'organizer_website' => 'required|url',
            'status' => 'required|numeric',
        ]);

        $booking = Booking::find($id);
        $booking->title = $request->title;
        $booking->description = $request->description;
        $booking->location = $request->location;
        $booking->price = $request->price;
        $booking->category_id = $request->category;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->o_name = $request->organizer_name;
        $booking->o_phone = $request->organizer_phone;
        $booking->o_email = $request->organizer_email;
        $booking->o_website = $request->organizer_website;
        $booking->status = $request->status;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bookings'), $imageName);
            $booking->image = $imageName;
        }
        $booking->save();
        return redirect()->route('admin.bookings')->with('success', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete event
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->route('admin.bookings')->with('success', 'Event Deleted Successfully');
    }
}
