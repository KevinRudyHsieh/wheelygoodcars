@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Stap 2: Gegevens controleren & Prijs instellen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Kenteken:</strong> {{ $tempData['license_plate'] }}</p>
                        <p><strong>Merk:</strong> {{ $mockData['brand'] }}</p>
                        <p><strong>Model:</strong> {{ $mockData['model'] }}</p>
                        <p><strong>Brandstof:</strong> {{ $mockData['fuel_type'] }}</p>
                        <p><strong>Vermogen:</strong> {{ $mockData['horsepower'] }} kW</p>
                        @if($mockData['aantal_cilinders'] && $mockData['cilinderinhoud'])
                        <p><strong>Motor:</strong> {{ $mockData['aantal_cilinders'] }} cyl × {{ $mockData['cilinderinhoud'] }} cc</p>
                        @endif
                        <p><strong>Catalogusprijs:</strong> € {{ number_format($mockData['catalogusprijs'] ?? 0, 2, ',', '.') }}</p>
                        <p><strong>APK vervalt:</strong> {{ $mockData['vervaldatum_apk'] ?? 'Onbekend' }}</p>
                        <p><strong>Aantal wielen:</strong> {{ $mockData['aantal_wielen'] ?? 'Onbekend' }}</p>
                        <p><strong>Leeg gewicht / rijklaar:</strong> {{ $mockData['massa_ledig_voertuig'] ?? 'Onbekend' }} kg / {{ $mockData['massa_rijklaar'] ?? 'Onbekend' }} kg</p>

                        <input type="hidden" name="brand" value="{{ $mockData['brand'] }}">
                        <input type="hidden" name="model" value="{{ $mockData['model'] }}">
                        <input type="hidden" name="production_year" value="{{ $mockData['production_year'] }}">
                        <input type="hidden" name="color" value="{{ $mockData['color'] }}">
                        <input type="hidden" name="fuel_type" value="{{ $mockData['fuel_type'] }}">
                        <input type="hidden" name="horsepower" value="{{ $mockData['horsepower'] }}">
                        <input type="hidden" name="catalogusprijs" value="{{ $mockData['catalogusprijs'] }}">
                        <input type="hidden" name="vervaldatum_apk" value="{{ $mockData['vervaldatum_apk'] }}">
                        <input type="hidden" name="aantal_wielen" value="{{ $mockData['aantal_wielen'] }}">
                        <input type="hidden" name="aantal_cilinders" value="{{ $mockData['aantal_cilinders'] }}">
                        <input type="hidden" name="cilinderinhoud" value="{{ $mockData['cilinderinhoud'] }}">
                        <input type="hidden" name="massa_ledig_voertuig" value="{{ $mockData['massa_ledig_voertuig'] }}">
                        <input type="hidden" name="massa_rijklaar" value="{{ $mockData['massa_rijklaar'] }}">
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Verkoopprijs (€)</label>
                            <input type="number" name="price" class="form-control" placeholder="Bijv. 15000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kilometerstand</label>
                            <input type="number" name="mileage" class="form-control" placeholder="Bijv. 85000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto van de auto (optioneel):</label>
                            <input type="file" name="car_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success w-100">Auto definitief te koop zetten</button>
            </form>
        </div>
    </div>
</div>
@endsection
