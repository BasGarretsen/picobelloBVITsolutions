@extends('layout')

@section('content')

    <content>
        <h1>Open activiteiten</h1>

        <section class="cards">
        @foreach($activities as $activity)            
            <div class="card">
                <img src="{{$activity['image']}}" alt="Placeholder">
                <br>
                <h3>{{$activity['activity_name']}}</h3>
                <p>{{$activity['location']}}</p>
                <p>{{$activity['start_time']}} - {{$activity['end_time']}}</p>
                <p>0/{{$activity['maximum_number_of_participants']}}</p>
                <a href="/activitydetails/{{$activity['id']}}">
                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Details
                </button>
                </a>
            </div>    
        @endforeach
        </section>
    </content>
        
@endsection