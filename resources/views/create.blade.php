<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Auto Toevoegen (A1)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('cars.create.one.post') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kenteken</label>
                            <input type="text" name="license_plate" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Merk</label>
                            <input type="text" name="brand" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Model</label>
                            <input type="text" name="model" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Prijs (€)</label>
                            <input type="number" step="0.01" name="price" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kilometerstand</label>
                            <input type="number" name="mileage" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Bouwjaar (production_year)</label>
                            <input type="number" name="production_year" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Volgende Stap
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
