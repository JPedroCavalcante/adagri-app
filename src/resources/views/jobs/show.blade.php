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
                            {{ $job->name }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Salário' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ str_replace('.', ',' ,$job->salary)  }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Status' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $job->active == 1 ? 'Ativa' : 'Inativa' }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Tipo' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            @switch($job->type)
                                @case('clt')
                                    CLT
                                    @break
                                @case('legal_person')
                                    Pessoa Jurídica
                                    @break
                                @case('freelancer')
                                    Free Lancer
                                    @break
                            @endswitch
                        </p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Criada em' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ Carbon\Carbon::parse($job->created_at)->format('H:i:s d/m/Y') }}
                        </p>
                    </div>

                    <div class="flex inline-flex w-full">
                        @if(
                        Auth::user()->type === 'applicant' && $job->active &&
                        !Auth::user()->applicant->jobs->contains('id', $job->id)
                        )
                            <form method="post" action="{{route('jobs.attachApplicant', $job->id)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <x-primary-button>{{ __('Candidatar-se') }}</x-primary-button>
                            </form>
                        @endif
                        <a href="{{ route('jobs.index') }}"
                           class="bg-blue-500 text-white px-4 -mr-2 py-2 border rounded-md">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
