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
    </div>
    <div style="max-width: 95%; width: max-content;" class="overflow-x-auto sm:rounded-lg text-black my-10 mx-10 shadow-2xl">
        <table class="text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-yellow-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Activiteit naam
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="material-icons">pin_drop</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Eten inbegrepen?
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start tijd
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Eind tijd
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prijs
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Min deelnemers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Max deelnemers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alleen werknemers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Upgedate op
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aangemaakt op 
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
                @foreach ($activities as $activity)
                @php
                $employOnly = "Nee";

                if ($activity->employees_only) {
                $employOnly = "Ja";
                }
                @endphp
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $activity->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $activity->activity_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->location }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->food_included ? 'Ja' : 'Nee' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->start_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->end_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->minimum_number_of_participants }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->maximum_number_of_participants }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employOnly }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->updated_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('activities.edit', $activity->id) }}" class="text-indigo-600 hover:text-indigo-900"><span class="material-icons">edit</span></a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('activity.destroy', $activity->id) }}" method="POST">
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