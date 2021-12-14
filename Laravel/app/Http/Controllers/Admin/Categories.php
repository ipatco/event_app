<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->type = $request->type;
        $category->slug = str_replace(' ', '-', strtolower($request->name));
        $category->status = $request->status;
        $category->save();

        return redirect()->back()->with('success', 'Category added successfully');
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
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $category = (new Category())->find($id);
        $category->name = $request->name;
        $category->type = $request->type;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = (new Category())->find($id);
        if ($category && ($category->type == 'event' || $category->type == 'both')) {
            // get all booking of events of this category
            $events = $category->event()->get();
            if ($events->count() > 0) {
                foreach ($events as $event) {
                    if ($event->bookings()->count() > 0) {
                        return redirect()->back()->with('error', 'This category has Booking.');
                    }
                }
            }
        }
        if ($category && ($category->type == 'service' || $category->type == 'both')) {
            // get all booking of events of this category
            $services = $category->service()->get();
            if ($services->count() > 0) {
                foreach ($services as $service) {
                    if ($service->bookings()->count() > 0) {
                        return redirect()->back()->with('error', 'This category has Booking.');
                    }
                }
            }
        } else {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully');
        }
    }
}
