@extends('layout')

@section('content')

<form method="POST" action="{{ route('activityregistrationguests', ['returnL' => $returnL, 'activityId' => $activity->id]) }}"
" class="max-w-lg mx-auto bg-[#f5af00] my-10 p-10 rounded-2xl shadow-2xl" enctype="multipart/form-data">
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
            <input type="text" id="firstname" name="firstname" value="" placeholder="Voornaam" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>
        <div class="mb-5">
            <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 text-white">Achternaam</label>
            <input type="text" id="lastname" name="lastname" value="" placeholder="Achternaam" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 text-white">Email</label>
            <input type="email" id="email" name="email" value="" placeholder="Email" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  />
        </div>
        <div class="mb-5"> 
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 text-white">Phone (optioneel) +31</label>
            <input type="tel" 
                id="phone" 
                name="phone" 
                value="" 
                placeholder="06 12345678" 
                class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                pattern="^(06\s?\d{8}|6\s?\d{8}|(20|21|22|23|24|25|26|27|28|29|30|31|32|33|34|35|36|37|38|39|40|41|42|43|44|45|46|47|48|49|50|51|52|53|54|55|56|57|58|59|60|61|62|63|64|65|66|67|68|69|70|71|72|73|74|75|76|77|78|79|80|81|82|83|84|85|86|87|88|89|90|91|92|93|94|95|96|97|98|99)\s?\d{7})$" />
        </div>
        
    </div>

   

    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
</form>

@endsection