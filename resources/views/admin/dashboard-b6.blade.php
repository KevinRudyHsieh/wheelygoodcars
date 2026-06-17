@extends('layouts.app')

@section('content')
    <h1>Dashboard Hoofdkantoor</h1>
    <p>Totaal auto's in database: {{ $data['total_cars'] }}</p>
@endsection
