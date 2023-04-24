<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {

        //TODO: change so that only necessary data is sent to the frontend
        return Inertia::render('Index/Index', [
            'foodItems' => \App\Models\FoodItem::with('image')->get(),
            'rooms' => \App\Models\Room::with('image')->get(),
        ]);
    }
}
