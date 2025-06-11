<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight lg:text-3xl">
            <i class="fas fa-user text-green-500"></i>
            {{ $student->name }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight lg:text-3xl">
            <i class="fas fa-book text-green-500"></i>
            {{ $student->subject->name }}
        </h2>
    </x-slot>

    <div class="py-8 px-2 lg:px-12">
        <div class="flex flex-col lg:flex-row lg:grid-cols-2 gap-4 mb-4">
            <div class="w-full bg-white flex flex-col justify-center border border-gray-200 rounded-xl py-2 px-2 shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-2">Objectifs</h2>
                <p class="my-2 text-center text-lg">{!! $student->goals !!}</p>
            </div>
            <div class="w-full bg-white flex flex-col justify-center border border-gray-200 rounded-xl py-2 px-2 shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-2">Commentaires</h2>
                <p class="my-2 text-center text-lg">{!! $student->comments !!}</p>
            </div>
        </div>

        <div class="bg-white flex flex-col justify-center rounded-xl shadow-lg border border-gray-200 w-[300px] mx-auto py-2">
            <h2 class="text-2xl font-bold text-center mb-2">
                Total Heures
            </h2>
            <p class="my-2 text-center text-xl text-center">
                {{ $student->courses_sum_duration }}
            </p>
        </div>

        @foreach ($student->courses as $course)
            <div class="mt-4 border-2 bg-white border border-gray-200 shadow-lg rounded-xl py-4 px-2">
                <div class="flex justify-center items-center gap-4">
                    <i class="fas fa-calendar-day"></i>
                    <h2 class="font-bold">Date</h2>
                    <p>{{ $course->date->format('d/m/Y') }}</p>

                    <i class="fas fa-clock"></i>
                    <h2 class="font-bold">Durée</h2>
                    <p>{{ $course->duration }}</p>
                </div>
                <div>
                    <h2 class="text-xl text-center font-bold mt-4">Notions abordées</h2>
                    <p class="text-lg text-center">{!! $course->learned_notions !!}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
