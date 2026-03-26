@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Stap 2: Gegevens controleren & Prijs instellen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('cars.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Kenteken:</strong> {{ $tempData['license_plate'] }}</p>
                        <p><strong>Merk:</strong> {{ $mockData['brand'] }}</p>
                        <p><strong>Model:</strong> {{ $mockData['model'] }}</p>

                        <input type="hidden" name="brand" value="{{ $mockData['brand'] }}">
                        <input type="hidden" name="model" value="{{ $mockData['model'] }}">
                        <input type="hidden" name="production_year" value="{{ $mockData['production_year'] }}">
                        <input type="hidden" name="color" value="{{ $mockData['color'] }}">
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
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success w-100">Auto definitief te koop zetten</button>
            </form>
        </div>
    </div>
</div>
@endsection
