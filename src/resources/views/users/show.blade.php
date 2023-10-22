<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Detalhar' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Nome' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $user->name }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Email' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $user->email  }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Tipo' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            @switch($user->type)
                                @case('admin')
                                    Admin
                                    @break
                                @case('applicant')
                                    Candidato
                                    @break
                            @endswitch
                        </p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Criado em' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ Carbon\Carbon::parse($user->created_at)->format('H:i:s d/m/Y') }}
                        </p>
                    </div>

                    <div class="flex inline-flex w-full">
                        <a href="{{ route('users.index') }}"
                           class="bg-blue-500 text-white px-4 ml-3 -mr-2 h-9 py-1 border rounded-md">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
