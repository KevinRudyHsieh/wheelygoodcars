@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hier plaatsen we de titel die eerst in de x-slot stond --}}
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Mijn Aangeboden Auto\'s') }}
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border">

                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Voorraad Beheer</h3>
                    </div>
                    <div class="flex gap-4 items-start">
                        <a href="{{ route('tags.index') }}" class="btn bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            📊 Tag Overzicht
                        </a>
                        <a href="{{ route('cars.create.one') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Auto Toevoegen
                        </a>
                    </div>
                </div>

                <table class="table table-striped min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kenteken</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Merk & Model</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prijs</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">aanbieder</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tags</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cars as $car)
                        <tr>
                            <td>
                                @if($car->image_path)
                                    <img src="{{ asset('storage/' . $car->image_path) }}" style="width: 100px; height: auto;" alt="Auto">
                                @else
                                    <span>Geen foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-blue-600">{{ $car->license_plate }}</td>
                            <td class="px-6 py-4">{{ $car->brand }} {{ $car->model }}</td>
                            <td class="px-6 py-4">€ {{ number_format($car->price, 2, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $car->user?->name ?? 'Onbekend' }}</td> {{-- VOEG TOE --}}
                            <td class="px-6 py-4">
                                @foreach($car->tags as $tag)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @if($car->sold_at)
                                    <span class="text-red-500 font-bold">Verkocht</span>
                                @else
                                    <span class="text-green-500 font-bold">In Voorraad</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('cars.show', $car->id) }}">Bekijk</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
