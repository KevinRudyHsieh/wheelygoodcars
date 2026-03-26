@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-body text-center">
            <h3 class="mb-4">Auto Toevoegen</h3>
            <form action="{{ route('cars.create.one.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Voer het kenteken in</label>
                    <input type="text" name="license_plate" class="form-control form-control-lg text-center font-monospace" placeholder="XX-YY-ZZ" required autofocus>
                    @error('license_plate') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Check Kenteken</button>
            </form>
        </div>
    </div>
</div>
@endsection
