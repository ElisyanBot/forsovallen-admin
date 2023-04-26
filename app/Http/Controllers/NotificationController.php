<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = array();

        if($request->user()->notifications()) {
           foreach ( $request->user()->notifications()->get() as $notification) {
               $data[] = $notification->data;
            }
        }

        return Inertia::render('Admin/Reservations', [
            'reservations' => $data,
        ]);
    }
}
