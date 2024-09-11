@extends('layout')

@section('content')

    <content>
        <h1>Open activiteiten</h1>

        <section class="cards">
            <!-- @foreach($activiteiten as $activiteit) -->
            <div class="card">
                <img src="" alt="Placeholder">
                <br>
                <h3>Activityname</h3>
                <p>Locatie</p>
                <p>Start tijd - Eind tijd</p>
                <p>0/(maxDeelnemers)</p>
            </div>
            <!-- @endforeach -->
        </section>
    </content>
        
@endsection