<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($user) ? 'Editar' : 'Criar' }} Vaga
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(isset($user))
                        <form method="post" action="{{route('users.update', $user->id)}}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf
                            @isset($user)
                                @method('put')
                            @endisset

                            <div>
                                <x-input-label for="name" value="Nome"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="$user->name ?? old('name')" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email ?? old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <x-input-label for="type" value="Tipo"/>
                                <select class="form-control" name="type">
                                    <option value="clt" @if ($user->type == 'admin') selected @endif>Admin</option>
                                    <option value="applicant" @if ($user->type == 'applicant') selected @endif>Candidato</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                                <a href="{{ route('users.index') }}"
                                   class="bg-blue-500 text-white px-4 -mr-2 py-2 border rounded-md">Voltar</a>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Nome')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Senha')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Senha de confirmação')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex flex-col mt-4">
                                <x-input-label for="type" value="Tipo"/>
                                <select class="form-control" name="type">
                                    <option value="admin">Admin</option>
                                    <option value="applicant">Candidato</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4 mt-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                                <a href="{{ route('users.index') }}"
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
