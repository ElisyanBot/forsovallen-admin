<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
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
        FoodItem::create($request->validate([
            'name' => 'required|string',
            'desc' => 'required|string',
            'status' => 'required|boolean',
            'price' => 'required|int',
            'by_category_id' => 'int',
        ]));

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
