@extends('layout')

@section('content')

<div class="activityDetail">
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-center w-1/3 flex justify-center mx-auto text-green-700 px-4 py-3 my-[25px] rounded" role="alert">
        <strong class="font-bold pr-2">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-center w-1/3 flex justify-center mx-auto text-red-400 px-4 py-3 my-[25px] rounded" role="alert">
        <strong class="font-bold pr-2">Let op!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>

    <div class="bg-yellow-500 text-white font-bold py-2 px-4 rounded mx-[25px] lg:mx-[50px] mt-[0] flex-col lg:flex-row flex ">
@endif
@if (!session('error') && !session('succes'))
    <div class="bg-yellow-500 text-white font-bold py-2 px-4 rounded m-[25px] lg:m-[50px] flex-col lg:flex-row flex ">
@endif
        <div class="lg:w-[50%] h-auto p-[15px] lg:p-[30px]">
            <img src="{{ asset('images/' . $activity->image) }}" class="w-full rounded-2xl h-96" alt="There used to be an image here">
        </div>
        <div class="lg:w-[50%] h-auto p-[15px] lg:p-[30px]">
            <h2 class="text-4xl font-bold mb-4">{{ $activity->activity_name }}</h2>
            <ul class="max-w-full">
                <li class="flex items-center"><span class="material-icons">pin_drop</span>: <span class="text-black font-normal ml-2">{{ $activity->location }}</span></li>
                <li class="flex items-center"><span class="material-icons">restaurant</span>: <span class="text-black font-normal ml-2">{{ $activity->including_food }}</span></li>
                <li class="flex items-center"><span class="material-icons">schedule</span>: <span class="text-black font-normal ml-2">{{ $activity->start_time }}</span></li>
                <li class="flex items-center"><span class="material-icons">alarm_off</span>: <span class="text-black font-normal ml-2">{{ $activity->end_time }}</span></li>
                <li class="flex items-center"><span class="material-icons">euro</span>: <span class="text-black font-normal ml-2">{{ number_format($activity->price, 2) }}</span></li>
                <li class="flex items-center"><span class="material-icons">group</span>: <span class="text-black font-normal ml-2">{{ $activity->maximum_number_of_participants }}</span></li>
                <li class="flex items-center"><span class="material-icons">person</span>: <span class="text-black font-normal ml-2">{{ $activity->minimum_number_of_participants }}</span></li>
                <li class="flex items-center"><span class="material-icons">edit_document</span>: <span class="text-black font-normal ml-2">{{ $registration_count }}</span></li>
                @if ($activity->supplies != null)
                    <li class="mt-2">Benodigdheden:</li>
                    <li class="text-black font-normal">{{ $activity->supplies }}</li>
                @endif
                <li class="mt-2">Beschrijving:</li>
                <li class="text-black font-normal">{{ $activity->description }}</li>
            </ul>
            @if(!$registered)
                @if($activity->maximum_number_of_participants != $registration_count)
                    <div class="w-full flex justify-end">
                        <a href="/activityregistration/{{$activity['id']}}">
                            <button class="bg-white text-black hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-2 m-4">
                                Aanmelden
                            </button>
                        </a>
                    </div>
                @else
                    <div class="w-full flex justify-end">
                        <p class="my-[10px]">Deze activiteit zit vol</p>
                    </div>
                @endif
            @else
                <div class="w-full flex justify-end">
                        <a href="/activityderegistration/{{$activity['id']}}">
                            <button class="bg-white text-black hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-2 m-4">
                                Afmelden
                            </button>
                        </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection