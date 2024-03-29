<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des élèves') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- new student creation button -->
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-2 flex flex-row justify-center">
                    <button class="p-2 text-lg bg-green-200 text-green-600 rounded-lg">
                        <i class="fas fa-plus mr-2"></i>
                        <a href="{{ route('student.create') }}">Ajouter un élève</a>
                    </button>
                </div>
            </div>
            <!-- main table component -->
            <div class="bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-auto">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-2">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Nom</th>
                                    <th class="py-3 px-6 text-center">Client</th>
                                    <th class="py-3 px-6 text-center">Matière</th>
                                    <th class="py-3 px-6 text-center">Statut</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            @foreach($students as $student)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <span class="py-1 px-3 rounded-lg text-lg">
                                            {{ $student->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-lg text-sm">
                                            <i class="fas fa-user mr-2"></i>
                                            {{ $student->customer->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-lg text-sm">
                                            <i class="fas fa-book mr-2"></i>
                                            {{ $student->subject->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="{{ $student->active ? "bg-green-200 text-green-600" : "bg-red-200 text-red-600" }} py-1 px-3 rounded-lg text-sm">
                                            <i class="fas {{$student->active ? "fa-check text-green-500" : "fa-close text-red-500"}}"></i>
                                            {{ $student->active ? "Actif" : "Inactif"}}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <div class="w-6 mr-2 transform text-blue-500 hover:text-purple-500 hover:scale-110">
                                                <a href="{{ route('student.show', $student) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-6 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{ route('student.edit', $student) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
