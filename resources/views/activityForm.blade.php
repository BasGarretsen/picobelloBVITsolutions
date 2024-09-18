@extends('layout')

@section('content')


<form method="POST" action="{{ route('storeActivity') }}" class="max-w-lg mx-auto bg-[#f5af00] my-10 p-10 rounded-2xl shadow-2xl">
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
    <h1 class="text-4xl text-white font-bold mb-4">Create activity</h1>
    <div class="grid grid-cols-2 gap-3">
        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Activity name</label>
            <input type="text" id="activity_name" name="activity_name" placeholder="Activity name" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Location</label>
            <input type="text" id="location" name="location" placeholder="Location" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Start time</label>
            <input type="datetime-local" id="start_time" name="start_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">End time</label>
            <input type="datetime-local" id="end_time" name="end_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Price</label>
            <input type="text" id="price" name="price" value="0" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Minimum participants</label>
            <input type="text" id="minimum_participants" value="0" name="minimum_participants" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Maximum participants</label>
            <input type="text" id="maximum_participants" placeholder="Maximum participants" name="maximum_participants" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Image</label>
            <input type="text" id="image" name="image" placeholder="Image URL" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>

        <div class="mb-5">
            <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 text-white">Food included</label>
            <select name="food_included" style="width: 100px">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>
    </div>

    <div class="mb-5">
        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 text-white">Description</label>
        <textarea type="text" id="description" placeholder="Activity description" name="description" class="h-32 shadow-sm border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required></textarea>
    </div>

    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create activity</button>
</form>

@endsection