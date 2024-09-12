@extends('layout')

@section('content')

<div class="container">
    <div class="bg-yellow-500 text-white font-bold py-2 px-4 rounded m-[50px] w flex">
        <div class="w-[50%] h-auto p-[30px]">
            <img src="{{ $activity->image }}" class="w-full" alt="text">
        </div>
        <div class="w-[50%] h-[50px] p-[30px]">
            <h2 class="">{{ $activity->activity_name }}</h2>
            <ul>
                <li>{{ $activity->location }}</li>
                <li>{{ $activity->including_food }}</li>
                <li>{{ $activity->description }}</li>
                <li>{{ $activity->start_time }}</li>
                <li>{{ $activity->end_time }}</li>
                <li>{{ $activity->price }}</li>
                <li>{{ $activity->maximum_number_of_participants }}</li>
                <li>{{ $activity->minimum_number_of_participants }}</li>
                <li>{{ $activity->supplies }}</li>
            </ul>

        </div>
    </div>

</div>

@endsection