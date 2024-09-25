@extends('layout')

@section('content')

<div class="activityDetail">
    <div class="bg-yellow-500 text-white font-bold py-2 px-4 rounded m-[25px] lg:m-[50px] flex-col lg:flex-row flex ">
        <div class="lg:w-[50%] h-auto p-[15px] lg:p-[30px]">
            <img src="{{ $activity->image }}" class="w-full rounded-2xl" alt="There used to be an image here">
        </div>
        <div class="lg:w-[50%] h-auto p-[15px] lg:p-[30px]">
            <h2 class="text-4xl font-bold mb-4">{{ $activity->activity_name }}</h2>
            <ul class="max-w-full">
                <li>Locatie: <span class="text-black font-normal">{{ $activity->location }}</li>
                <li>Eten inbegrepen: <span class="text-black font-normal">{{ $activity->including_food }}</li>
                
                <li>Start tijd: <span class="text-black font-normal">{{ $activity->start_time }}</span></li>
                <li>End tijd: <span class="text-black font-normal">{{ $activity->end_time }}</span></li>
                <li>Price: <span class="text-black font-normal">{{ number_format($activity->price, 2) }}</span></li>
                <li>Max. deelnemers: <span class="text-black font-normal">{{ $activity->maximum_number_of_participants }}</span></li>
                <li>Min. deelnemers: <span class="text-black font-normal">{{ $activity->minimum_number_of_participants }}</span></li>
                @if ($activity->supplies != null)
                    <li class="mt-2">Benodigdheden:</li>
                    <li class="text-black font-normal">{{ $activity->supplies }}</li>
                @endif
                <li class="mt-2">Beschrijving:</li>
                <li class="text-black font-normal">{{ $activity->description }}</li>
            </ul>

        </div>
    </div>

</div>

@endsection