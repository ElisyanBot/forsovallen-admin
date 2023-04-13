<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index ()
    {
        return Inertia::render('Admin/Index', [
            'foodItems' => FoodItem::all()
        ]);
    }
}
