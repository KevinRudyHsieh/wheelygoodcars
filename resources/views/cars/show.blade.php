@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $car->brand }} {{ $car->model }}</h2>
                        <p class="text-sm text-gray-600">Kenteken: {{ $car->license_plate }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('cars.pdf', $car) }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Download PDF
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}"
                            alt="Foto van {{ $car->brand }}"
                            style="max-width: 400px; height: auto; display: block; margin-bottom: 20px;">
                        @else
                            <p>Geen foto beschikbaar</p>
                        @endif
                    </div>
                    <div>
                        <p><strong>Prijs:</strong> € {{ number_format($car->price, 2, ',', '.') }}</p>
                        <p><strong>Kilometerstand:</strong> {{ $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : 'Onbekend' }}</p>
                        <p><strong>Bouwjaar:</strong> {{ $car->production_year ?? 'Onbekend' }}</p>
                    </div>
                    <div>
                        <p><strong>Kleur:</strong> {{ $car->color ?? 'Onbekend' }}</p>
                        <p><strong>Aangeboden door:</strong> {{ $car->user?->name ?? 'Onbekend' }}</p>
                        <p><strong>Geplaatst op:</strong> {{ $car->created_at?->format('d-m-Y') ?? 'Onbekend' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
