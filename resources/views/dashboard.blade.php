@extends('layout')

@section('content')

<h1 class="font-bold text-4xl">Welcome {{ Auth::user()->name }}</h1>


<div style="display: flex; flex-direction: column; align-items: center;">
    <div class="buttonDiv">
        <a href="/create_activity">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Create Activity
            </button>
        </a>

        <a href="/register">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Register User
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
                        Activity name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Food included?
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        End time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Max participants
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Min participants
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Employees only
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Updated at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                @php
                    $employOnly = "No";

                    if ($activity->employees_only) {
                        $employOnly = "Yes";
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
                        {{ $activity->food_included ? 'Yes' : 'No' }}
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
                        {{ $activity->maximum_number_of_participants }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->minimum_number_of_participants }}
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
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection