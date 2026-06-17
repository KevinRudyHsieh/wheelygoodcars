<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Dit dwingt af dat de gebruiker ingelogd is én de 'admin' middleware doorstaat
        $this->middleware(['auth', 'admin']);
    }
    public function index()
    {
        // 1. Aanbieders zonder telefoonnummer (of leeg/null)
        $missingPhone = User::where(function($q) {
            $q->whereNull('phone_number')->orWhere('phone_number', '');
        })->get();

        // 2. Te mooi om waar te zijn (auto's onder de 1000 euro)
        $tooCheapCars = Car::where('price', '<', 1000)->get();

        // 3. Geen tags gebruikt (deze is krachtig!)
        $noTagsUsed = User::whereDoesntHave('cars.tags')->get();

        return view('admin.aanbieders-check', compact('missingPhone', 'tooCheapCars', 'noTagsUsed'));
    }
    public function dashboard()
    {
        // Hier verzamelen we de data
        $data = [
            'total_cars' => \App\Models\Car::count(),
            'total_users' => \App\Models\User::count(),
        ];

        return view('admin.dashboard-b6', compact('data'));
    }
}
