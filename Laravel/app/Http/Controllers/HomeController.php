<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('created_at')->where('status', '=', '1')->where('end_date', '>=', date('Y-m-d'))->limit(12)->get();
        $services = Service::orderByDesc('created_at')->where('status', '=', '1')->limit(12)->get();
        return view('web.home', compact('events', 'services'));
    }

    public function search(Request $request)
    {
        $keyword = $request->q;
        $events = Event::orderByDesc('created_at')->where('status', '=', '1')->where('end_date', '>=', date('Y-m-d'))->where('title', 'like', '%' . $keyword . '%')->get();
        $services = Service::orderByDesc('created_at')->where('status', '=', '1')->where('title', 'like', '%' . $keyword . '%')->get();
        return view('web.search', compact('events', 'services'));
    }

    public function events()
    {
        $category = request()->category;
        $events = Event::orderByDesc('created_at')->where('status', '=', '1')->where('end_date', '>=', date('Y-m-d'))->where(function ($query) use ($category) {
            if ($category) {
                $query->where('category_id', '=', $category);
            }
        })->get();
        return view('web.events', compact('events'));
    }

    public function services()
    {
        $category = request()->category;
        $services = Service::orderByDesc('created_at')->where('status', '=', '1')->where(function ($query) use ($category) {
            if ($category) {
                $query->where('category_id', '=', $category);
            }
        })->get();
        return view('web.services', compact('services'));
    }

    public function service_detail($slug)
    {
        $service = Service::where('slug', $slug)->where('status', '=', '1')->first();
        return view('web.service_detail', compact('service'));
    }

    public function event_detail($slug)
    {
        $event = Event::with('category')->where('slug', $slug)->where('status', '=', '1')->where('end_date', '>=', date('Y-m-d'))->first();
        return view('web.event_detail', compact('event'));
    }

    public function service_booking($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $ser = Service::find($id);
        $event = 0;
        $service = 1;
        $user = auth()->user()->id;
        $vendor = $ser->user_id;
        $title = $ser->title;
        $time = $ser->sale_price_type;
        $price = $ser->sale_price != null ? $ser->sale_price : $ser->price;
        $type = 's';
        return view('web.booking', compact('event', 'service', 'id', 'user', 'vendor', 'title', 'time', 'price', 'type'));
    }

    public function event_booking($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $eve = Event::find($id);
        $event = 1;
        $service = 0;
        $user = auth()->user()->id;
        $vendor = $eve->user_id;
        $title = $eve->title;
        $time = null;
        $price = $eve->sale_price != null ? $eve->sale_price : $eve->price;
        $type = 'e';
        return view('web.booking', compact('event', 'service', 'id', 'user', 'vendor', 'eve', 'title', 'time', 'price', 'type'));
    }

    public function booking(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'vendor_id' => 'required',
            'booking_date' => 'required|date',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
        ]);

        $booking = new Booking();
        $booking->event_id = $request->event_id;
        $booking->service_id = $request->service_id;
        $booking->user_id = $request->user_id;
        $booking->vendor_id = $request->vendor_id;
        $booking->booking_date = $request->booking_date;
        $booking->num_of_people = $request->num_of_people;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->save();

        $id = $booking->id;

        return redirect()->route('booking.pay', $id)->with('success', 'Make a payment to confirm your booking');
    }

    public function payment($id)
    {
        $booking = Booking::find($id);
        if ($booking->event_id != null) {
            $event = Event::find($booking->event_id);
            $title = $event->title;
            $type = 'e';
            $price = $event->price;
            if ($event->sale_price > 0) {
                $price = $event->sale_price;
            }
        }

        if ($booking->service_id != null) {
            $service = Service::find($booking->service_id);
            $title = $service->title;
            $price = $service->price;
            $type = 's';
            if ($service->sale_price > 0) {
                $price = $service->sale_price;
            }
        }
        // dd($price);
        return view('web.payment', compact('booking', 'price', 'title', 'type'));
    }

    public function makePayment(Request $request, $id)
    {
        $a = [
            "_token" => "Xc1N4pIfDdLJbkPYW4V3NcVhKvGruWrqeQGIOeys",
            "stripeToken" => "tok_1JzmMrHRBKMPFxQOgu2w7h4A",
            "stripeTokenType" => "card",
            "stripeEmail" => "admin@log.in"
        ];
        $validator = $request->validate([
            'stripeToken' => 'required',
            'stripeTokenType' => 'required',
            'stripeEmail' => 'required'
        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $token = $stripe->tokens->retrieve(
            $request->stripeToken
        );
        $booking = Booking::find($id);

        // Redirect to paypal for payment
        $transaction = new Transaction();
        //user_id 	booking_id 	payment_id 	payment_status 	payment_type 	payment_amount 	payment_currency
        $transaction->user_id = auth()->user()->id;
        $transaction->booking_id = $id;
        $transaction->payment_id = $token->id;
        $transaction->payment_status = 'success';
        $transaction->payment_type = 'Stripe: ' . $token->type;
        $transaction->payment_amount = $request->amount;
        $transaction->payment_currency = 'usd';
        $transaction->save();

        // Send Mail to user
        $user = auth()->user();
        $bookings = Booking::with(['event', 'service', 'transaction'])->orderByDesc('created_at')->where('id', '=', $id)->get()->first();
        if ($bookings->event_id != null) {
            $event = Event::find($bookings->event_id);
            $title = $event->title;
            $type = 'event';
            $price = $event->price;
            if ($event->sale_price > 0) {
                $price = $event->sale_price;
            }
        }
        if ($bookings->service_id != null) {
            $service = Service::find($bookings->service_id);
            $title = $service->title;
            $price = $service->price;
            $type = 'service';
            if ($service->sale_price > 0) {
                $price = $service->sale_price;
            }
        }
        $data = array(
            'name' => $booking->name,
            'email' => $booking->email,
            'phone' => $booking->phone,
            'booking_date' => $booking->booking_date,
            'num_of_people' => $booking->num_of_people,
            'title' => $title,
            'amount' => $price,
            'type' => $type,
            'booking_id' => $booking->id
        );
        // Mail::send('emails.booking_confirm', $data, function ($message) use ($booking) {
        //     $message->from('email@example.com', 'Log');
        //     $message->to($booking->email, $booking->name)->subject('Booking Confirmation');
        // });

        return redirect()->route('home')->with('success_mail', 'Payment Successful. You will receive a confirmation email shortly.');
    }
}
