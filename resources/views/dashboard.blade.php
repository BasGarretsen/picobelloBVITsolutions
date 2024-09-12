@extends('layout')

@section('content')

<h1 class="font-bold text-4xl">Welcome {{ Auth::user()->name }}</h1>

<div class="overflow-x-auto sm:rounded-lg text-black my-10 mx-10 shadow-2xl">
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
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    1
                </th>
                <td class="px-6 py-4">
                    Test
                </td>
                <td class="px-6 py-4">
                    Doetinchem
                </td>
                <td class="px-6 py-4">
                    Yes
                </td>
                <td class="px-6 py-4">
                    12/12/2024 - 12:00
                </td>
                <td class="px-6 py-4">
                    12/12/2024 - 14:00
                </td>
                <td class="px-6 py-4">
                    $300
                </td>
                <td class="px-6 py-4">
                    200
                </td>
                <td class="px-6 py-4">
                    10
                </td>
                <td class="px-6 py-4">
                    12/12/2024 - 12:00
                </td>
                <td class="px-6 py-4">
                    12/12/2024 - 14:00
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection