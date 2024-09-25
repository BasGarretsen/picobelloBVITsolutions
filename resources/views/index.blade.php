@extends('layout')

@section('content')

<content>
    <h1 class="text-center font-bold text-4xl my-10 uppercase">Open activiteiten</h1>

    <div class="flex justify-center">
        <section class="cards block md:grid md:grid-cols-2 lg:grid-cols-3 my-10 gap-10">
            @foreach($activities as $activity)
            <div class="card bg-[#f5af00] w-72 rounded-2xl shadow-2xl my-10 md:my-0">
                <img style="height: 200px" src="{{$activity['image']}}" alt="Placeholder" class="w-72 rounded-2xl p-4">
                <br>
                <div class="px-4 md:p-4 text-white">
                    <h3 class="font-bold text-2xl pb-2">{{$activity['activity_name']}}</h3>
                    <p>Locatie: <span class="text-black">{{$activity['location']}}</span></p>
                    <p>Start tijd: <span class="text-black">{{$activity['start_time']}}</span></p>
                    <p>Eind tijd: <span class="text-black">{{$activity['end_time']}}</span></p>
                    <p>Max deelnemers: <span class="text-black">{{$activity['maximum_number_of_participants']}}</span></p>
                </div>

                <a href="/activitydetails/{{$activity['id']}}">
                <button class="bg-white text-black hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-2 m-4">
                    Details
                </button>
                </a>
            </div>
            @endforeach
        </section>
    </div>
</content>

@endsection
