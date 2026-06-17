<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function getDashboardData()
    {
        return response()->json([
            'total_cars' => Car::count(),
            'cars_today' => Car::whereDate('created_at', today())->count(),
            'total_users' => User::count(),
            // ... etc
        ]);
    }
}
