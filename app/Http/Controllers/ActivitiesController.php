<?php

namespace App\Http\Controllers;

use App\Models\activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function createFormRef()
    {
        if (Auth::user()->role === "admin") {
            return view('activityForm');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'activity_name' => 'required',
            'location' => 'required',
            'food_included' => 'required',
            'description' => 'required',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date',
            'price' => 'required',
            'maximum_participants' => 'required',
            'minimum_participants' => 'required',
            'image' => 'required',
            // 'supplies' => 'required'
        ]);


        $activity = new Activities();

        $activity->activity_name = $validateData['activity_name'];
        $activity->location = $validateData['location'];
        $activity->including_food = $validateData['food_included'];
        $activity->description = $validateData['description'];
        $activity->start_time = $validateData['start_time'];
        $activity->end_time = $validateData['end_time'];
        $activity->price = $validateData['price'];
        $activity->maximum_number_of_participants = $validateData['maximum_participants'];
        $activity->minimum_number_of_participants = $validateData['minimum_participants'];
        $activity->image = $validateData['image'];
        // 'supplies' => $request->

        $activity->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(activities $activities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activity = activities::findOrFail($id);

        return view('edit-activities', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $activity = activities::findOrFail($id);

    // Define validation rules
    $rules = [
        'activity_name' => 'sometimes|required|min:3',
        'location' => 'sometimes|required',
        'including_food' => 'sometimes|required',
        'description' => 'sometimes|required',
        'start_time' => 'sometimes|required|date|before:end_time',
        'end_time' => 'sometimes|required|date',
        'price' => 'sometimes|required',
        'maximum_number_of_participants' => 'sometimes|required',
        'minimum_number_of_participants' => 'sometimes|required',
        'image' => 'sometimes|required',
        'supplies' => 'sometimes|required',
    ];

    $this->validate($request, $rules);

    $activity->activity_name = $request->input('activity_name', $activity->activity_name);
    $activity->location = $request->input('location', $activity->location);
    $activity->including_food = $request->input('including_food', $activity->including_food);
    $activity->description = $request->input('description', $activity->description);
    $activity->start_time = $request->input('start_time', $activity->start_time);
    $activity->end_time = $request->input('end_time', $activity->end_time);
    $activity->price = $request->input('price', $activity->price);
    $activity->maximum_number_of_participants = $request->input('maximum_number_of_participants', $activity->maximum_number_of_participants);
    $activity->minimum_number_of_participants = $request->input('minimum_number_of_participants', $activity->minimum_number_of_participants);
    $activity->image = $request->input('image', $activity->image);
    $activity->supplies = $request->input('supplies', $activity->supplies);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->hashName();
        $activity->image = $filename;
    }

    $activity->save();

    return redirect()->route('dashboard');
}
    /**
     * Remove the specified resource from storage.
     */
    
}
