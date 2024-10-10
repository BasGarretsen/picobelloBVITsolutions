@extends('layout')

@section('content')

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div style="display: flex; flex-direction: column; align-items: center;" class="my-10">

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-center w-1/3 flex justify-center mx-auto text-green-700 px-4 py-3 my-3 rounded" role="alert">
        <strong class="font-bold pr-2">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-center flex justify-center mx-auto text-red-400 px-4 py-3 my-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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

        <div class="searchFunc" style="width: 100%; height: 40px; display: flex; justify-content: center; margin-top: 20px">
            <form action="{{ route('dashboardSearch') }}" method="GET">
                @csrf
                <input type="text" name="query" id="query" class="text-black font-bold py-2 px-4 rounded" style="border: solid black 1px">
                <input type="submit" value="Zoeken" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" style="">
            </form>
        </div>
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
                        <span class="material-icons">schedule</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="material-icons">alarm_off</span>
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
                <tr class="bg-white border-b hover:bg-gray-50 hover:cursor-pointer" onclick="openModal({{ $activity }})">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $activity->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $activity->activity_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->start_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->end_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity->created_at }}
                    </td>
                    <td class="px-6 py-4">
                    <a href="{{ route('activities.edit', $activity->id) }}" class="text-indigo-600 hover:text-indigo-900" onclick="event.stopPropagation();"><span class="material-icons">edit</span></a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('activity.destroy', $activity->id) }}" method="POST" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="event.stopPropagation();" class="text-red-600 hover:text-red-900"><span class="material-icons">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Modal Structure -->
<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #f5af00 !important;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="activityModalLabel">Activity Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 id="modalActivityName" class="text-white font-bold"></h2>
                <img src="" alt="" id="modalImage" class="rounded-t-lg pb-2 h-60">
                <div class="">
                    <ul class="flex flex-col gap-1">
                        <li><strong class="text-white font-bold pr-1">Locatie:</strong> <span id="modalLocation"></span></li>
                        <li><strong class="text-white font-bold pr-1">Eten inbegrepen:</strong> <span id="modalIncludingFood"></span></li>
                        <li><strong class="text-white font-bold pr-1">Begin tijd:</strong> <span id="modalStartTime"></span></li>
                        <li><strong class="text-white font-bold pr-1">Eind tijd:</strong> <span id="modalEndTime"></span></li>
                        <li><strong class="text-white font-bold pr-1">Kosten:</strong> <span id="modalPrice"></span></li>
                        <li><strong class="text-white font-bold pr-1">Max Deelnemers:</strong> <span id="modalMaxParticipants"></span></li>
                        <li><strong class="text-white font-bold pr-1">Min Deelnemers:</strong> <span id="modalMinParticipants"></span></li>
                        <li><strong class="text-white font-bold pr-1">Benodigdheden:</strong> <span id="modalSupplies"></span></li>
                        <li><strong class="text-white font-bold pr-1">Omschrijving:</strong><br> <span id="modalDescription"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(activity) {
        document.getElementById('modalActivityName').innerText = activity.activity_name;
        document.getElementById('modalImage').src = '/images/' + activity.image;
        document.getElementById('modalLocation').innerText = activity.location;
        document.getElementById('modalIncludingFood').innerText = activity.including_food;
        document.getElementById('modalStartTime').innerText = activity.start_time;
        document.getElementById('modalEndTime').innerText = activity.end_time;
        document.getElementById('modalPrice').innerText = activity.price;
        document.getElementById('modalMaxParticipants').innerText = activity.maximum_number_of_participants;
        document.getElementById('modalMinParticipants').innerText = activity.minimum_number_of_participants;
        document.getElementById('modalSupplies').innerText = activity.supplies || 'N/A';
        document.getElementById('modalDescription').innerText = activity.description;
        document.querySelector('.modal-footer .btn-primary').href = `/dashboard/edit/${activity.id}`;
        $('#activityModal').modal('show');
    }
</script>