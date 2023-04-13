<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index ()
    {
        return Inertia::render('Admin/Index', [
            'foodItems' => \App\Models\FoodItem::all(),
            'foodCategories' => \App\Models\FoodCategory::all(),
        ]);
    }
}
