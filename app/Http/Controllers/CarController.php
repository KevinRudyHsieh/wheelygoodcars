<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // A2: Overzicht (Mijn Auto's)
    public function myCars()
    {
        $cars = Auth::user()->cars;
        return view('mycars', compact('cars'));
    }

    // A1: Stap 1 (Kenteken)
    public function createStepOne()
    {
        return view('create');
    }

    // A1: Verwerk Stap 1
    public function postStepOne(Request $request)
    {
        $validated = $request->validate(['license_plate' => 'required|string']);
        session(['car_temp_data' => $validated]);
        return redirect()->route('cars.create.two');
    }

    // A1: Stap 2 (Prijs & Check)
    public function createStepTwo()
    {
        $tempData = session('car_temp_data');
        if (!$tempData) return redirect()->route('cars.create.one');

        // B1: Hier komt later de RDW API, voor nu mock data
        $mockData = ['brand' => 'Volkswagen', 'model' => 'Golf'];

        return view('createprice', compact('tempData', 'mockData'));
    }

    // A1: Opslaan in Database
    public function store(Request $request)
    {
        $tempData = session('car_temp_data');
        $validated = $request->validate([
            'price' => 'required|numeric',
            'brand' => 'required',
            'model' => 'required'
        ]);

        Car::create([
            'user_id' => Auth::id(),
            'license_plate' => $tempData['license_plate'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price' => $validated['price'],
        ]);

        session()->forget('car_temp_data');
        return redirect()->route('cars.my')->with('success', 'Auto geplaatst!');
    }

    // A3: Verwijderen
    public function destroy(Car $car)
    {
        if ($car->user_id === Auth::id()) {
            $car->delete();
        }
        return redirect()->route('cars.my')->with('success', 'Verwijderd.');
    }
}
