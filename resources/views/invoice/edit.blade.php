<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mise à jour statut facture') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" mx-auto p-4 bg-white border-b border-gray-200">
                    <form action="{{ route('invoice.update', $invoice->id) }}" method="post" class="flex flex-col">
                        @csrf
                        @method('patch')

                        <label class="mt-2">Facture payée</label>
                        <div class="mt-2 flex gap-4">
                            <div>
                                <input type="radio" id="paid_no" name="paid" value="0" @if ($invoice->paid == 0) checked @endif>
                                <label for="paid_no" class="text-red-500 font-bold">NON</label>
                            </div>
                            <div>
                                <input type="radio" id="paid_yes" name="paid" value="1" @if ($invoice->paid == 1) checked @endif>
                                <label for="paid_yes" class="text-green-600 font-bold">OUI</label>
                            </div>
                        </div>

                        <input type="submit" value="Confirmer" class="p-2 mt-4 rounded-lg bg-green-400">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
