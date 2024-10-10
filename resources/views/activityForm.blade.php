@extends('layout')

@section('content')


<form method="POST" action="{{ route('storeActivity') }}" enctype="multipart/form-data" class="max-w-lg mx-auto bg-[#f5af00] my-10 p-10 rounded-2xl shadow-2xl">
    @csrf
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-center flex justify-center mx-auto text-red-400 px-4 py-3 my-3 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1 class="text-4xl text-white font-bold mb-4">Activiteit aanmaken</h1>
    <div class="grid grid-cols-2 gap-3">
        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Activiteit naam</label>
            <input type="text" id="activity_name" name="activity_name" placeholder="Activity name" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Locatie</label>
            <input type="text" id="location" name="location" placeholder="Location" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Start tijd</label>
            <input type="datetime-local" id="start_time" name="start_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required min="{{ now()->format('Y-m-d\TH:i') }}" />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Eind tijd</label>
            <input type="datetime-local" id="end_time" name="end_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required min="{{ now()->format('Y-m-d\TH:i') }}" />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Prijs</label>
            <input type="text" id="price" name="price" value="0" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Minimale deelnemers</label>
            <input type="text" id="minimum_participants" value="0" name="minimum_participants" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Maximale deelnemers</label>
            <input type="text" id="maximum_participants" placeholder="Maximum participants" name="maximum_participants" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div>
            <label for="image" class="block mb-2 text-sm font-medium dark:text-white">Upload Image</label>
            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" class="text-black border sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <p id="file-error" class="text-red-600 text-sm mt-2 hidden">Please upload a valid image file (JPEG, PNG, WEBP).</p>
        </div>

        <div class="mb-5">
            <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 text-white">Eten inbegrepen</label>
            <select name="food_included" style="width: 100px">
                <option value="nee">Nee</option>
                <option value="ja">Ja</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Alleen werknemers</label>
            <input type="checkbox" id="image" name="employOnly" placeholder="Image URL" />
        </div>
    </div>

    <div class="mb-5">
        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Beschrijving</label>
        <textarea type="text" id="description" placeholder="Activity description" name="description" class="h-32 shadow-sm border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required></textarea>
    </div>

    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create activity</button>
</form>

@endsection

<script>
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        const errorText = document.getElementById('file-error');
        const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

        if (file && !validTypes.includes(file.type)) {
            errorText.classList.remove('hidden');
            this.value = '';
        } else {
            errorText.classList.add('hidden');
        }
    });
</script>