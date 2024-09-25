@extends('layout')

@section('content')

<form method="POST" action="{{ isset($activity) ? route('activities.update', $activity->id) : route('storeActivity') }}" class="max-w-lg mx-auto bg-[#f5af00] my-10 p-10 rounded-2xl shadow-2xl" enctype="multipart/form-data">
    @csrf
    @if (isset($activity))
        @method('PUT') <!-- Use PUT for updating -->
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

    <h1 class="text-4xl text-white font-bold mb-4">{{ isset($activity) ? 'Update Activiteit' : 'Activiteit aanmaken' }}</h1>

    <div class="grid grid-cols-2 gap-3">
        <div class="mb-5">
            <label for="activity_name" class="block mb-2 text-sm font-medium text-gray-900 text-white">Activiteit Naam</label>
            <input type="text" id="activity_name" name="activity_name" value="{{ isset($activity) ? $activity->activity_name : old('activity_name') }}" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="mb-5">
            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 text-white">Locatie</label>
            <input type="text" id="location" name="location" value="{{ isset($activity) ? $activity->location : old('location') }}" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Start tijd</label>
            <input type="datetime-local" id="start_time" name="start_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $activity->start_time }}"/>
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Eind tijd</label>
            <input type="datetime-local" id="end_time" name="end_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $activity->end_time}}" />
        </div>

        <div class="mb-5">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 text-white">Prijs</label>
            <input type="text" id="price" name="price" value="{{ isset($activity) ? $activity->price : old('price') }}" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="mb-5">
            <label for="minimum_participants" class="block mb-2 text-sm font-medium text-gray-900 text-white">Minimale deelnemers</label>
            <input type="text" id="minimum_participants" name="minimum_participants" value="{{ isset($activity) ? $activity->minimum_number_of_participants : old('minimum_participants') }}" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="mb-5">
            <label for="maximum_participants" class="block mb-2 text-sm font-medium text-gray-900 text-white">Maximale deelnemers</label>
            <input type="text" id="maximum_participants" name="maximum_participants" value="{{ isset($activity) ? $activity->maximum_number_of_participants : old('maximum_participants') }}" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="mb-5">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 text-white">Foto URL</label>
            <input type="text" id="image" name="image" value="{{ isset($activity) ? $activity->image : old('image') }}" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="mb-5">
            <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 text-white">Eten inbegrepen</label>
            <select name="food_included" id="">
            <option value="" disabled>Kies optie</option>
            <option value="yes" {{ old('including_food', $activity->including_food) === 'ja' ? 'selected' : '' }}>Ja</option>
            <option value="no" {{ old('including_food', $activity->including_food) === 'nee' ? 'selected' : '' }}>Nee</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="employee_only" class="block mb-2 text-sm font-medium text-gray-900 text-white">Alleen werknemers</label>
            <input type="checkbox" id="employee_only" name="employee_only" {{ isset($activity) && $activity->employees_only ? 'checked' : '' }} />
        </div>
        
    </div>

    <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 text-white">Beschrijving</label>
        <textarea id="description" name="description" class="h-32 shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ isset($activity) ? $activity->description : old('description') }}</textarea>
    </div>

    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
</form>

@endsection