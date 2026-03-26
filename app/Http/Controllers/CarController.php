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
        $cars = Auth::user()->cars;
        return view('mycars', compact('cars'));
    }

    /**
     * Toon een overzicht van alle auto's (B1/B2)
     */
    public function index()
    {
        // Haal alle auto's op, maar zet de nieuwste (created_at) bovenaan (descending)
        $cars = Car::orderBy('created_at', 'desc')->get();

        // Stuur ze naar de view
        return view('my-cars', compact('cars'));
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
        $response = Http::get("https://opendata.rdw.nl/resource/m9nd-m9wp.json?kenteken=" . $kenteken);

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

        $validated = $request->validate([
            'price' => 'required|numeric',
            'brand' => 'required|string',
            'model' => 'required|string',
            // Voeg deze toe voor A1 volledigheid:
            'mileage' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'color' => 'nullable|string',
        ]);

        Car::create([
            'user_id'         => Auth::id(),
            'license_plate'   => $tempData['license_plate'],
            'brand'           => $validated['brand'],
            'model'           => $validated['model'],
            'price'           => $validated['price'],
            // Vergeet deze niet, anders blijft je database leeg of geeft hij errors:
            'mileage'         => $request->mileage,
            'production_year' => $request->production_year,
            'seats'           => $request->seats ?? 5, // Gebruik een fallback
            'doors'           => $request->doors ?? 4,
        ]);

        session()->forget('car_temp_data');

        // Let op: controleer of je route echt 'cars.my' heet of 'cars.my-cars'
        return redirect()->route('cars.my')->with('success', 'Auto succesvol geplaatst!');
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
