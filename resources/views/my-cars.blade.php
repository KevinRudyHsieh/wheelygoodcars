@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hier plaatsen we de titel die eerst in de x-slot stond --}}
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Mijn Aangeboden Auto\'s') }}
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border">

                <div class="flex justify-between mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Voorraad Beheer</h3>
                    <a href="{{ route('cars.create.one') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Auto Toevoegen
                    </a>
                </div>

                <table class="table table-striped min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kenteken</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Merk & Model</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prijs</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cars as $car)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-blue-600">{{ $car->license_plate }}</td>
                            <td class="px-6 py-4">{{ $car->brand }} {{ $car->model }}</td>
                            <td class="px-6 py-4">€ {{ number_format($car->price, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Weet je het zeker?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold border-0 bg-transparent">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
