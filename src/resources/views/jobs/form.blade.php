<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($job) ? 'Editar' : 'Criar' }} Vaga
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(isset($job))
                        <form method="post" action="{{route('jobs.update', $job->id)}}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf]
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
                                <x-input-label for="type" value="Tipo"/>
                                <select class="form-control" name="type">
                                    <option value="clt" @if ($job->type == 'clt') selected @endif>CLT</option>
                                    <option value="legal_person" @if ($job->type == 'legal_person') selected @endif>Pessoa Jurídica</option>
                                    <option value="freelancer" @if ($job->type == 'freelancer') selected @endif>Free lancer</option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <x-input-label for="active" value="Status"/>
                                <select class="form-control" name="active">
                                    <option value="0" @if ($job->active == false) selected @endif>Inativa</option>
                                    <option value="1" @if ($job->active == true) selected @endif>Ativa</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                                <a href="{{ route('jobs.index') }}"
                                   class="bg-blue-500 text-white px-4 -mr-2 py-2 border rounded-md">Voltar</a>
                            </div>
                        </form>
                    @else
                        <form method="post" action="{{ route('jobs.store') }}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf
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
                                <a href="{{ route('jobs.index') }}"
                                   class="bg-blue-500 text-white px-4 -mr-2 py-2 border rounded-md">Voltar</a>
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
