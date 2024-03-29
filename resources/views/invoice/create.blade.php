<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajout de nouvelle facture') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto w-1/2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('invoice.store') }}" method="post">
                        @csrf
                            <label>Nom du client</label>
                            <select name="customer" class="rounded-lg w-full">
                                <option value="">-- Choisir un client --</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer')
                                <p class="text-xl text-red-400">{{ $message }}</p>
                            @enderror

                        <input type="submit" class="bg-green-400 rounded p-2 mt-4 w-full" value="Confirmer"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
