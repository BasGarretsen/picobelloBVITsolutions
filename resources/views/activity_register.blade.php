@extends('layout')

@section('content')

<form method="POST" action="{{ route('activityregistrationguests', $activity->id) }}" class="max-w-lg mx-auto bg-[#f5af00] my-10 p-10 rounded-2xl shadow-2xl" enctype="multipart/form-data">
    @csrf
    @if (isset($activity))
        @method('POST') <!-- Use PUT for updating -->
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-center flex justify-center mx-auto text-red-400 px-4 py-3 my-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-4xl text-white font-bold mb-4">Aanmelden voor {{ $activity->activity_name }}</h1>

    <div class="grid grid-cols-1 gap-3">
        <div class="mb-5">
            <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 text-white">Voornaam</label>
            <input type="text" id="firstname" name="firstname" value="" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>

        <div class="grid grid-cols-1 gap-3">
        <div class="mb-5">
            <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 text-white">Achternaam</label>
            <input type="text" id="lastname" name="lastname" value="" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>
        <div class="grid grid-cols-1 gap-3">
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 text-white">Email</label>
            <input type="email" id="email" name="email" value="" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>
        
    </div>

   

    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
</form>

@endsection