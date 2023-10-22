{{-- use AppLayout Component located in app\View\Components\AppLayout.php which use resources\views\layouts\app.blade.php view --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Usuários' }}
            </h2>
                <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Adicionar
                    usuário</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                        <tr>
                            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nome</th>
                            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Email</th>
                            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Tipo</th>
                            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Criado em</th>
                            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Ações</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach ($users as $user)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $user->name }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $user->email }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    @switch($user->type)
                                        @case('admin')
                                            Admin
                                            @break
                                        @case('applicant')
                                            Candidato
                                            @break
                                    @endswitch
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ Carbon\Carbon::parse($user->created_at)->format('H:i:s d/m/Y') }}</td>
                                <td class="flex inline-flex justify-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="border border-blue-500 hover:bg-blue-500 hover:text-white h-9 px-4 mx-6 py-2 rounded-md">Detalhar</a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="border border-yellow-500 hover:bg-gray-100 hover:text-white h-9 px-6 py-2 rounded-md">Editar</a>
                                    <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                          class="mb-0 h-9 mx-6 inline">
                                        @csrf
                                        @method('delete')
                                        <button
                                            class="border border-red-500 hover:bg-red-500 hover:text-white h-9 px-4 py-2 rounded-md">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
