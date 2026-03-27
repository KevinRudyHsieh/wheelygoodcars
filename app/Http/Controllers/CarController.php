<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // A2: Overzicht (Mijn Auto's)
    public function myCars()
    {
        $user = auth()->user();
        // Haal alle auto's op, maar zet de nieuwste (created_at) bovenaan (descending)
        $cars = auth()->user()->cars()->orderBy('created_at', 'desc')->get();

        // Stuur ze naar de view
        return view('my-cars', compact('cars'));
    }

    /**
     * Toon een overzicht van alle auto's (B1/B2)
     */
    public function index()
    {
        // Haal alle auto's op, maar zet de nieuwste (created_at) bovenaan (descending)
        $cars = Car::orderBy('created_at', 'desc')->get();

        // Stuur ze naar de view
        return view('index-cars', compact('cars'));
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

        $kenteken = strtoupper(str_replace('-', '', $tempData['license_plate']));

        // B1: De echte RDW API aanroep
        // Zoek naar de Http::get regel in je createStepTwo functie en vervang hem door deze:
       $response = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=" . $kenteken);

        if ($response->successful() && count($response->json()) > 0) {
            $rdwData = $response->json()[0];
            $mockData = [
                'brand' => $rdwData['merk'],
                'model' => $rdwData['handelsbenaming'],
                'color' => $rdwData['eerste_kleur'] ?? 'Onbekend',
                'production_year' => substr($rdwData['datum_eerste_toelating'], 0, 4),
            ];
        } else {
            // Als het kenteken niet gevonden wordt
            return redirect()->route('cars.create.one')->withErrors(['license_plate' => 'Kenteken niet gevonden bij de RDW.']);
        }

        return view('createprice', compact('tempData', 'mockData'));
    }

    // A1: Opslaan in Database
    public function store(Request $request)
{
    $tempData = session('car_temp_data');
    if (!$tempData) return redirect()->route('cars.create.one');

    // Valideer de binnenkomende data van het prijs-formulier
    $validated = $request->validate([
        'brand' => 'required|string',
        'model' => 'required|string',
        'price' => 'required|numeric',
        'mileage' => 'nullable|numeric',
        'production_year' => 'nullable|integer',
        'color' => 'nullable|string',
    ]);

    // B1 & A1: Opslaan in de database
    Car::create([
        'user_id' => auth()->id() ?? 1, // Koppel aan ingelogde gebruiker (of ID 1 als test)
        'license_plate' => $tempData['license_plate'],
        'brand' => $validated['brand'],
        'model' => $validated['model'],
        'price' => $validated['price'],
        'mileage' => $validated['mileage'] ?? 0,
        'production_year' => $validated['production_year'] ?? date('Y'),
        'color' => $validated['color'] ?? 'Onbekend',
    ]);

    // Sessie leegmaken na succes
    session()->forget('car_temp_data');

    // Terug naar het overzicht met een succesmelding
    return redirect()->route('cars.my-cars')->with('success', 'Auto succesvol te koop gezet!');
}

    // A3: Verwijderen
    public function destroy(Car $car)
    {
        if ($car->user_id === Auth::id()) {
            $car->delete();
        }
        return redirect()->route('cars.my-cars')->with('success', 'Verwijderd.');
    }
}
