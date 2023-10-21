<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($job) ? 'Editar' : 'Criar' }} Vaga
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    @if(isset($job))
                        <form method="post" action="{{route('jobs.update', $job->id)}}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf
                            {{-- add @method('put') for edit mode --}}
                            @isset($job)
                                @method('put')
                            @endisset

                            <div>
                                <x-input-label for="name" value="Nome"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="$job->name ?? old('name')" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div>
                                <x-input-label for="salary" value="Salário"/>
                                <x-text-input id="salary" name="salary" type="text" class="mt-1 block w-full"
                                              :value="$job->salary ?? old('salary')" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('salary')"/>
                            </div>

                            <div class="flex flex-col">
                                <x-input-label for="salary" value="Tipo"/>
                                <select class="form-control" name="type">
                                    <option value="clt">CLT</option>
                                    <option value="legal_person">Pessoa Jurídica</option>
                                    <option value="freelancer">Free lancer</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                                <a href="{{ route('jobs.index') }}" class="bg-blue-500 text-white px-4 -mr-2 py-2 border rounded-md">Voltar</a>
                            </div>
                        </form>
                    @else
                        <form method="post" action="{{ route('jobs.store') }}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf
                            {{-- add @method('put') for edit mode --}}
                            @isset($job)
                                @method('put')
                            @endisset

                            <div>
                                <x-input-label for="name" value="Nome"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="$job->name ?? old('name')" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div>
                                <x-input-label for="salary" value="Salário"/>
                                <x-text-input id="salary" name="salary" type="text" class="mt-1 block w-full"
                                              :value="$job->salary ?? old('salary')" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('salary')"/>
                            </div>

                            <div class="flex flex-col">
                                <x-input-label for="salary" value="Tipo"/>
                                <select class="form-control" name="type">
                                    <option value="clt">CLT</option>
                                    <option value="legal_person">Pessoa Jurídica</option>
                                    <option value="freelancer">Free lancer</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                                <a href="{{ route('jobs.index') }}" class="bg-blue-500 text-white px-4 -mr-2 py-2 border rounded-md">Voltar</a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
</x-app-layout>
