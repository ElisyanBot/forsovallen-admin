<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index ()
    {
        return Inertia::render('Admin/Index', [
            'foodItems' => \App\Models\FoodItem::with('image')->get(),
            'foodCategories' => \App\Models\FoodCategory::all(),
            'events' => \App\Models\Event::all(),
            'rooms' => \App\Models\Room::all(),
        ]);
    }
}
