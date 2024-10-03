@extends('layout')

@section('content')

<div style="display: flex; flex-direction: column; align-items: center;" class="my-10">

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-center w-1/3 flex justify-center mx-auto text-green-700 px-4 py-3 my-3 rounded" role="alert">
        <strong class="font-bold pr-2">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="buttonDiv">
        <a href="/create_activity">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Activiteit aanmaken
            </button>
        </a>

        <a href="/register">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Gebruiker registreren
            </button>
        </a>

        <a href="/userdashboard">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                User dashboard
            </button>
        </a>
    </div>
    <div style="max-width: 95%; width: max-content;" class="overflow-x-auto sm:rounded-lg text-black my-10 mx-10 shadow-2xl">
        <table class="text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-yellow-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gebruikersnaam
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rol
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gemaakt op
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="material-icons">edit</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="material-icons">delete</span>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $user->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->role }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('user.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900"><span class="material-icons">edit</span></a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900"><span class="material-icons">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection