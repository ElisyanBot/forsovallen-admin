<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\FoodItemImage;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foodItem = FoodItem::create($request->validate([
            'name' => 'required|string',
            'desc' => 'required|string',
            'status' => 'required|boolean',
            'price' => 'required|int',
            'by_category_id' => 'int',
        ]));

        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,svg'
            ], [
                'image.image' => 'Filen måste vara en bild',
                'image.mimes' => 'Filen måste vara en bild',
            ]);
            $path = $request->file('image')->store('FoodItemImg','public');
            $foodItem->image()->save(new FoodItemImage([
                'filename' => $path
            ]));
        }

        return redirect('/admin')->with('success', 'Ett föremål har skapts till menyn');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodItem $foodItem)
    {
        return FoodItem::find($foodItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodItem $foodItem)
    {
        $foodItem->update($request->validate([
            'name' => 'required|string',
            'desc' => 'required|string',
            'status' => 'required|boolean',
            'price' => 'required|int',
            'by_category_id' => 'int',
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodItem $foodItem)
    {
        $foodItem->delete();
    }
}
