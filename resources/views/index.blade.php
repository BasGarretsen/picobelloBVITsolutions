@extends('layout')

@section('content')

    <content>
        <h1>Open activiteiten</h1>

        <section class="cards">
            
            <div class="card">
                <img src="" alt="Placeholder">
                <br>
                <h3>Activityname</h3>
                <p>Locatie</p>
                <p>Start tijd - Eind tijd</p>
                <p>0/(maxDeelnemers)</p>

                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Details
                </button>
            </div>    
        
        </section>
    </content>
        
@endsection