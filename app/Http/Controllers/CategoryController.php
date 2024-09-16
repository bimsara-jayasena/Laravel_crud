<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Catagory;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Catagory::all();
        return view('profile.dashboard', compact('catagories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.AddCatagory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $fields = $request->validated();
        $check = Catagory::where('catagory', $fields['catagory'])->first();

        if ($check) {
            return redirect()->back()->with('error', "Category is already exist!");
        }
        Catagory::create($fields);
        return redirect()->back()->with('success', 'done');
    }

    
    public function show(string $id) {}

    public function edit(string $id)
    {
        //
    }

    public function update(CategoryRequest $request, string $id)
    {
        $category = Catagory::find($id);
        Gate::authorize('update', $category);
        $fields = $request->validated();

        $category->catagory = $request->input('catagory');
        $category->save();
        return redirect()->back()->with('success', 'updated success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Catagory::find($id);
        Gate::authorize('delete', $category);
        Item::where('catagory_id',$id)->delete();
       
        $category->delete();
        return redirect()->back()->with('success', 'record deleted success');
    }
}
