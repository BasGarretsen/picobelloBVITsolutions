@extends('layout')

@section('content')

<div class="container">
    <div class="bg-yellow-500 text-white font-bold py-2 px-4 rounded m-[50px] w flex">
        <div class="w-[50%] h-auto p-[30px]">
            <img src="{{ $activity->image }}" class="w-full rounded-2xl" alt="There used to be an image here">
        </div>
        <div class="w-[50%] h-auto p-[30px]">
            <h2 class="text-4xl font-bold mb-4">{{ $activity->activity_name }}</h2>
            <ul>
                <li>Location: {{ $activity->location }}</li>
                <li>Food included: {{ $activity->including_food }}</li>
                
                <li>Start time: {{ $activity->start_time }}</li>
                <li>End time: {{ $activity->end_time }}</li>
                <li>Price: {{ number_format($activity->price, 2) }}</li>
                <li>Max. participants: {{ $activity->maximum_number_of_participants }}</li>
                <li>Min. participants: {{ $activity->minimum_number_of_participants }}</li>
                <li class="mt-2">Discription:</li>
                <li>{{ $activity->description }}</li>
                @if ($activity->supplies != null)
                    <li class="mt-2">Supplies:</li>
                    <li>{{ $activity->supplies }}</li>
                @endif
            </ul>

        </div>
    </div>

</div>

@endsection