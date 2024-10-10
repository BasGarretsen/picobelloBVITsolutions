@extends('layout')

@section('content')

<content>
    <h1 class="text-center font-bold text-4xl my-10 uppercase">Activiteiten</h1>

    <div class="flex justify-center">
        <section class="cards block md:grid md:grid-cols-2 lg:grid-cols-3 my-10 gap-10">
            @foreach($activities as $activity)
                @php
                    $activityReg = [];
                    $registered = false;

                    foreach($registrations as $registration) {
                        if ($registration->activity_id == $activity->id) {
                            array_push($activityReg, $registration);
                        }
                        
                        if (Auth::check())
                        {
                            if ($registration->activity_id == $activity->id && $registration->user_id == Auth::user()->id)
                            {
                                $registered = true;
                            }
                        }
                    }

                    $registration_count = count($activityReg);

                @endphp
            <div class="card bg-[#f5af00] w-72 rounded-2xl shadow-2xl my-10 md:my-0">
                <img style="height: 200px" src="{{ asset('images/' . $activity->image) }}" alt="Placeholder" class="w-72 rounded-2xl p-4">
                <br>
                <div class="px-4 md:p-4 text-white">
                    <h3 class="font-bold text-2xl pb-2">{{$activity['activity_name']}}</h3>
                    <p class="flex items-center pb-1 gap-1"><span class="material-icons">pin_drop</span>: <span class="text-black">{{$activity['location']}}</span></p>
                    <p class="flex items-center pb-1 gap-1"><span class="material-icons">schedule</span>: <span class="text-black">{{$activity['start_time']}}</span></p>
                    <p class="flex items-center pb-1 gap-1"><span class="material-icons">alarm_off</span>: <span class="text-black">{{$activity['end_time']}}</span></p>
                    <p class="flex items-center pb-1 gap-1"><span class="material-icons">group</span>: <span class="text-black">{{$activity['maximum_number_of_participants']}}</span></p>
                    <p class="flex items-center pb-1 gap-1"><span class="material-icons">edit_document</span>: <span class="text-black">{{ $registration_count }}</span></p>
                </div>
                    <div class="flex flex-row">
                <a href="/activitydetails/{{$activity['id']}}">
                <button class="bg-white text-black hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-2 m-4">
                    Details
                </button>
                </a>
            @if(!$registered)
                @if($activity->maximum_number_of_participants != $registration_count)
                        <a href="/activityregistration/1/{{$activity['id']}}">
                            <button class="bg-white text-black hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-2 m-4">
                                Aanmelden
                            </button>
                        </a>
                @else
                        <p class="my-[10px] w-fit">Deze activiteit zit vol</p>
                @endif
            @else
                        <a href="/activityderegistration/1/{{$activity['id']}}">
                            <button class="bg-white text-black hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-2 m-4">
                                Afmelden
                            </button>
                        </a>
            @endif
            </div>
            </div>
            @endforeach
        </section>
    </div>
</content>

@endsection
