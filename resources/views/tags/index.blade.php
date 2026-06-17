@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Tag Statistieken
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($tags as $tag)
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                            <h3 class="text-lg font-bold text-blue-900 mb-4">{{ $tag->name }}</h3>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">📦 In Voorraad:</span>
                                    <span class="text-2xl font-bold text-green-600">{{ $tag->total_stock }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">✅ Verkocht:</span>
                                    <span class="text-2xl font-bold text-red-600">{{ $tag->total_sold }}</span>
                                </div>

                                <div class="border-t border-blue-300 pt-3 mt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-semibold">Totaal:</span>
                                        <span class="text-2xl font-bold text-blue-900">{{ $tag->total_stock + $tag->total_sold }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-full">Geen tags beschikbaar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
