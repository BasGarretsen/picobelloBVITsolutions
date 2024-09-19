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
        $activities = Activities::all();
        return view('index', ['activities' => $activities]);
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
    public function showActivityDetails(Request $request, $id)
    {
          $activity = activities::find($id);

          return view('activity_details', compact('activity'));
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
            'price' => 'required|numeric',
            'maximum_participants' => 'required|numeric',
            'minimum_participants' => 'required|numeric',
            'image' => 'required',
            // 'supplies' => 'required'
        ]);

        $employOnly = null;

        if ($request->employOnly != null) {
            $employOnly = true;
        } else {
            $employOnly = false;
        }

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
        $activity->employees_only = $employOnly;
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
    public function edit(activities $activities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, activities $activities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(activities $activities)
    {
        //
    }
}
