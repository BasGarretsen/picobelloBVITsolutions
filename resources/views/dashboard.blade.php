@extends('layout')

@section('content')
    
    <h1 class="font-bold text-4xl">Welcome {{ Auth::user()->name }}</h1>

            <div class="card">
                <img src="" alt="Placeholder">
                <br>
                <h3>Activityname</h3>
                <p>Locatie</p>
                <p>Start tijd - Eind tijd</p>
                <p>0/(maxDeelnemers)</p>
                <a class="border rounded p-2 bg-blue-500 text-white" href="#">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="border rounded p-2 bg-red-500 text-white" type="submit">Delete</button>
                    </form>
            </div>
        

@endsection