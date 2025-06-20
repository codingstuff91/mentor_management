<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="my-6 pt-4">
        <div class="px-2 mx-auto columns-2 gap-x-4 lg:columns-4 lg:gap-4 lg:max-w-7xl lg:px-8">
            <div class="bg-white border border-gray-400 shadow-lg rounded-xl p-4">
                <div class="flex justify-between items-center px-4 h-20">
                    <img class="h-full" src="{{ asset('img/time.png') }}">

                    <div class="flex flex-col gap-y-4 justify-center items-center">
                        <h2 class="text-sm sm:text-xl font-bold">Total Heures</h2>
                        <h3 class="text-sm sm:text-xl">{{ $totalCourses }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-400 shadow-lg rounded-xl p-4">
                <div class="flex justify-between items-center px-4 h-20">
                    <img class="h-full" src="{{ asset('img/lesson.png') }}">

                    <div class="flex flex-col gap-y-4 justify-center items-center">
                        <h2 class="text-sm sm:text-xl font-bold">Total Cours</h2>
                        <h3 class="text-sm sm:text-xl">{{ $totalCourses }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-400 shadow-lg rounded-xl p-4">
                <div class="flex justify-between items-center px-4 h-20">
                    <img class="h-full" src="{{ asset('img/money.png') }}">

                    <div class="flex flex-col gap-y-4 justify-center items-center">
                        <h2 class="text-sm sm:text-xl font-bold">Total revenus</h2>
                        <h3 class="text-sm sm:text-xl">{{ $totalRevenues }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-400 shadow-lg rounded-xl p-4">
                <div class="flex justify-between items-center px-4 h-20">
                    <img class="h-full" src="{{ asset('img/student.png') }}">

                    <div class="flex flex-col gap-y-4 justify-center items-center">
                        <h2 class="text-sm sm:text-xl font-bold">Total Eleves</h2>
                        <h3 class="text-sm sm:text-xl">{{ $totalStudents }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="max-w-7xl mx-auto flex flex-row sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl w-full">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl text-bold text-center sm:text-xl lg:text-3xl">Heures de cours par matières</h2>
                    <table class="rounded-l-lg w-full border-collapse mx-auto table-auto sm:w-2/3 lg:w-1/3 mt-4">
                        <thead>
                        <tr>
                            <th class="border-2 border-gray-600 text-sm bg-blue-500 text-white p-2 text-center sm:text-xl">
                                MATIERE
                            </th>
                            <th class="border-2 border-gray-600 text-sm bg-blue-500 text-white p-2 text-center sm:text-xl">
                                NOMBRE HEURES
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($totalHoursPerSubject as $subject => $hoursCount)
                            <tr>
                                <td class="border-2 border-gray-600 p-2 bg-blue-200 text-center sm:text-x">{{ $subject }}</td>
                                <td class="border-2 border-gray-600 p-2 bg-blue-200 text-center sm:text-x">{{ $hoursCount }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
