<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Catagory;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.AddItem');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Catagory::all();
        return view('profile.AddItem', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {

        $fields = $request->validated();
        $action = $request->user_action;

        
        
        Gate::authorize('create', Item::class);
        $category = Catagory::firstOrCreate(
            ['catagory' => $request->catagory],
            ['catagory' => $request->catagory]
        );

        $check = Item::where('item_name', $fields['item_name'])->first();
       

        $item = new Item();
        if ($check) {
            $duplicate_item = Item::where('item_name', $fields['item_name'])
                ->where('price', $fields['price'])
                ->where('catagory', $fields['catagory'])->first();
            if ($duplicate_item) {
                $duplicate_item->increment('quantity', $fields['quantity']);
                $category->increment('quantity', $fields['quantity']);
                return redirect()->back()->with('success', 'bal balablalalab added successfuly');
            } else {
                if ($action) {
                    if ($action === 'update') {
                        //updated.
                        $check->item_name = $fields['item_name'];

                          $check->price = $fields['price'];
                         $check->catagory = $fields['catagory'];
                         $check->catagory_id = $category->id;

                         $check->save();
                         $check->increment('quantity', $fields['quantity']);
                         $category->increment('quantity', $fields['quantity']); 

                        return redirect()->back()->with('success', 'New Item Added');
                    } else if ($action === 'save') {
                        $new_item = new Item();
                        $new_item->item_name = $fields['item_name'];
                        $new_item->quantity = $fields['quantity'];
                        $new_item->price = $fields['price'];
                        $new_item->catagory = $fields['catagory'];
                        $new_item->catagory_id = $category->id;
                        $new_item->save();
                        $category->increment('quantity', $fields['quantity']); 
                        return redirect()->back()->with('success', 'Item Updated');
                    }
                } else {
                    return redirect()->back()
                        ->withInput($fields)
                        ->with('duplicate', 'duplicate Item found');
                }
            }



           
        } else {
            $item->item_name = $fields['item_name'];
            $item->quantity = $fields['quantity'];
            $item->price = $fields['price'];
            $item->catagory = $fields['catagory'];
            $item->catagory_id = $category->id;
            $item->save();
        }

        $category->increment('quantity', $fields['quantity']); //make this fix also in delete
        return redirect()->back()->with('success', 'new record added successfuly');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $search_type=$request->search_type;
        $search_key=$request->search_key;
        
        if($search_type==='name'){
          
            $items = Item::whereRaw('LOWER(item_name) LIKE ?', ['%' . strtolower($search_key) . '%'])->get();
        }else if($search_type==='catagory'){
            $items=Item::where('catagory',$search_key)->get();
        }else{
            $items=Item::where('price',$search_key)->get();
        }
        if(!$items->isEmpty()){
            $categories = Catagory::all();
            
            return view('profile.Dashboard',compact('items','categories'));
            
        }else{
            
            $items=Item::all();
            $categories = Catagory::all();
            return redirect()->back()->with('error','No items found');
          
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, $id)
    {
        try {
            $item = Item::find($id);
            Gate::authorize('update', $item);
            $fields = $request->validated();
            $item->item_name = $request->input('item_name');
            $item->quantity = $request->input('quantity');
            $item->price = $request->input('price');
            $item->catagory = $request->input('catagory');
            $item->save();
            return redirect()->back()->with('success', 'updated successfuly');
        } catch (Exception $e) {
            return redirect()->back()->with('error:', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $item = Item::find($id);
        $id = $item->catagory_id;
        $quantity=$item->quantity;
        $delete_type=$request->delete_action;
        $category = Catagory::find($id);
         Gate::authorize('delete', $item);
        if($delete_type==='single'){
             $item->decrement('quantity',1);
             $category->decrement('quantity',1);
             return redirect()->back()->with('success','item removed');
        
        }
        else{
    
         $category->decrement('quantity',$quantity);
         $item->delete();
         return redirect()->back()->with('success','record removed');
            
        }
       
       
    }
}
