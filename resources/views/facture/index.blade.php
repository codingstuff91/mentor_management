<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des factures') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200 flex flex-row justify-between">
                    <button class="p-2 bg-green-300 rounded-lg">
                        <a href="{{ route('facture.create') }}">Créer une facture</a>
                    </button>
                </div>
            </div>
            <div class="mt-4 w-2/3 mx-auto p-2 bg-white border-b border-gray-200">
                @foreach ($factures as $facture)
                    <div class="my-4 flex flex-row justify-between w-3/4 mx-auto">
                        <h2 class="p-2 bg-lime-300 rounded-lg text-sm flex items-center"><i class="fas fa-user mr-2"></i>{{ $facture->client->nom }}</h2>
                        <h3 class="text-xl flex items-center"><i class="fas fa-calendar-day mr-2"></i>{{ $facture->month_year_creation }}</h3>
                        <h3 class="text-xl flex items-center">
                            {{ $facture->total }}€ 
                            @if ($facture->payee)
                                <span class="mx-2 text-xs rounded-lg p-2 bg-green-200">OUI</span>
                            @else
                                <span class="mx-2 text-xs rounded-lg p-2 bg-red-200">NON</span>
                            @endif
                        </h3>
                        <div>
                            <button>
                                <a href="{{ route('facture.show', $facture->id) }}" class="p-2 rounded-lg bg-blue-300 text-xs"><i class="fas fa-search mr-2"></i>Détails</a>
                            </button>
                            <button>
                                <a href="{{ route('facture.edit', $facture->id) }}" class="p-2 rounded-lg bg-cyan-300 text-xs"><i class="fas fa-edit mr-2"></i>Editer</a>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
