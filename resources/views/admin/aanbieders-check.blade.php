@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Beheerder: Aanbieders Review</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-bold text-red-600">Geen telefoonnummer</h2>
        <ul>
            @foreach($missingPhone as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-bold text-orange-600">Auto's < 1000 euro</h2>
        <ul>
            @foreach($tooCheapCars as $car)
                <li>{{ $car->brand }} {{ $car->model }} - €{{ $car->price }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
