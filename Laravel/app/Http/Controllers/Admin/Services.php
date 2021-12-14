<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;

class Services extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->get();
        $services = Service::with(['category', 'user'])->orderByDesc('created_at')->get();
        return view('admin.services.manage', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->get();
        return view('admin.services.create', compact('categories'));
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
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
        ]);

        $slug = $this->createSlug($request->title);

        $service = new Service();
        $service->title = $request->title;
        $service->slug = $slug;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->sale_price = $request->sale_price;
        $service->sale_price_type = $request->sale_price_type;
        $service->category_id = $request->category;
        $service->user_id = auth()->user()->id;
        $service->video = $request->video;
        $service->status = $request->status;
        $service->booking_status = $request->booking_status;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = $imageName;
        }
        $service->save();
        return redirect()->route('admin.services')->with('success', 'Service Created Successfully');
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
        $service = Service::find($id);
        $categories = Category::where('status', 1)->where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->get();
        return view('admin.services.edit', compact('categories', 'service'));
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
            'price' => 'required|numeric',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
        ]);

        $slug = $this->createSlug($request->title, $id);

        $service = Service::find($id);
        $service->title = $request->title;
        $service->slug = $slug;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->sale_price = $request->sale_price;
        $service->sale_price_type = $request->sale_price_type;
        $service->category_id = $request->category;
        $service->video = $request->video;
        $service->status = $request->status;
        $service->booking_status = $request->booking_status;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = $imageName;
        }
        $service->save();
        return redirect()->route('admin.services')->with('success', 'Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete service
        $service = Service::find($id);
        if ($service->bookings()->count() > 0) {
            return redirect()->back()->with('error', 'This Service has Booking.');
        }
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service Deleted Successfully');
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Service::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
