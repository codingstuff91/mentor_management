<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer un cours') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto sm:px-6 sm:w-2/3 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg drop-shadow-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form
                        action="{{ route('course.update', $course->id) }}"
                        method="post"
                        class="flex flex-col"
                    >
                        @csrf
                        @method('patch')

                        <label>Date du cours</label>
                        <input type="date" name="course_date" value="{{ $course->date->format('Y-m-d') }}" class="rounded-lg mt-2">

                        <label class="mt-2">Durée du cours</label>
                        <input type="time" name="duration" value="{{ $course->duration }}" class="rounded-lg mt-2">

                        <label class="mt-2">Cours payé</label>
                        <div class="mt-2 mb-4 flex justify-center gap-4">
                            <div>
                                <input type="radio" id="paid_no" name="paid" value="0" @if ($course->paid == 0) checked @endif>
                                <label for="paid_no" class="text-red-500 font-bold">NON</label>
                            </div>
                            <div>
                                <input type="radio" id="paid_yes" name="paid" value="1" @if ($course->paid == 1) checked @endif>
                                <label for="paid_yes" class="text-green-600 font-bold">OUI</label>
                            </div>
                        </div>

                        <textarea name="learned_notions" cols="30" rows="10">
                            {!! $course->learned_notions !!}
                        </textarea>

                        <label class="mt-2">Facture associée</label>
                        <select class="mt-2 mb-4 rounded-lg" name="invoice">
                            @foreach($latestInvoices as $invoice)
                                <option
                                    value="{{ $invoice->id }}"
                                    {{ $invoice->id === $course->invoice->id ? 'selected' : '' }}
                                >
                                    {{ $invoice->created_at->format('M-Y') }}
                                </option>
                            @endforeach
                        </select>

                        <input type="submit" value="Mettre à jour" class="p-2 mt-4 rounded-lg bg-green-400">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
