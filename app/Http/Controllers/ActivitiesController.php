<?php

namespace App\Http\Controllers;

use App\Models\activities;
use App\Models\activity_registrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = activity_registrations::all();

        if (Auth::check()) {
            $activities = activities::all();
        } else {
            $activities = activities::where('employees_only', false)->get();
        }

        return view('index', ['activities' => $activities, 'registrations' => $registrations]);
    }

    public function createFormRef()
    {
        if (Auth::check()) {
            if(Auth::user()->role === 'admin' || Auth::user()->role === 'owner') {
                return view('activityForm');
            }
            else {
                return redirect()->route('dashboard')->withErrors([
                    'email' => 'U bent niet bevoegd om een activiteit aan te maken.',
                ]);
            }
        } else {
            return redirect()->route('login')->withErrors([
                'email' => 'U moet ingelogd zijn.',
            ]);
        }
    }

        /**
     * Show the form for creating a new resource.
     */
    public function showActivityDetails( $activityId)
    {
        $activity = activities::find($activityId);
        $registered = false;

        $registrations = activity_registrations::where('activity_id', $activity->id)->get();
        $registration_count = $registrations->count();

        if (Auth::check()) {
            foreach ($registrations as $key => $registration) {
                if ($registration->user_id === Auth::user()->id) {
                    $registered = true;
                }
            }
        }

        return view('activity_details', ['activity' => $activity, 'registered' => $registered, 'registration_count' => $registration_count]);
    }

    public function registerForActivity($activityId)
    {
          $activity = activities::find($activityId);
          if (Auth::check()) {
            $activity_registration = new activity_registrations();
            $splitName = explode(' ', Auth::user()->name, 2);

            $activity_registration->activity_id = $activityId;
            $activity_registration->user_id = Auth::user()->id;
            $activity_registration->firstname = $splitName[0];
            $activity_registration->lastname = !empty($splitName[1]) ? $splitName[1] : '';
            $activity_registration->email = Auth::user()->email;
            
            $activity_registration->save();
        
            session()->flash('success', 'Je bent aangemeld voor deze activiteit!');
            return redirect()->route('activitydetails', ['activityId' => $activityId]);
          }else{
            return view('activity_register', ['activity' => $activity]);
          }
    }

    public function deregisterForActivity($activityId)
    {
        $activity = activities::find($activityId);
        $registrations = activity_registrations::where('activity_id', $activity->id)->get();
        if (Auth::check()) {
            foreach ($registrations as $key => $registration) {
                if ($registration->user_id === Auth::user()->id) {
                    $registration->delete();
                }
            }
        }
            session()->flash('success', 'Je bent afgemeld voor deze activiteit!');
            return redirect()->route('activitydetails', ['activityId' => $activityId]);
    }

    public function registerGuestForActivity(Request $request, $activityId)
    {
          $activity = activities::find($activityId);

          $registrations = activity_registrations::where('activity_id', $activity->id)->get();

            $validateData = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
            ]);

            foreach ($registrations as $key => $registration) {
                if (Str::upper($registration->email) === Str::upper($validateData['email'])) {
                    session()->flash('error', 'Je bent al aangemeld voor deze activiteit!');
                    return redirect()->route('activitydetails', ['activityId' => $activityId]);
                }
            }
            $activity_registration = new activity_registrations();

            $activity_registration->activity_id = $activityId;
            $activity_registration->firstname = $validateData['firstname'];
            $activity_registration->lastname = $validateData['lastname'];
            $activity_registration->email = $validateData['email'];
            if ($request->phone !=null) {
                $activity_registration->phone_number = $request->phone;
            }
            $activity_registration->save();
        
            session()->flash('success', 'Je bent aangemeld voor deze activiteit!');
            return redirect()->route('activitydetails', ['activityId' => $activityId]);
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
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $employeeOnly = $request->has('employee_only');

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
        $activity->image = $imageName;
        $activity->employees_only = $employeeOnly;

        $activity->save();

        session()->flash('success', 'De activiteit is aangemaakt!');
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

        $rules = [
            'activity_name' => 'sometimes|required|min:3',
            'location' => 'sometimes|required',
            'food_included' => 'sometimes|required',
            'description' => 'sometimes|required',
            'start_time' => 'sometimes|required|date|before:end_time',
            'end_time' => 'sometimes|required|date',
            'price' => 'sometimes|required',
            'maximum_number_of_participants' => 'sometimes|required',
            'minimum_number_of_participants' => 'sometimes|required',
            'image' => 'sometimes|required',
        ];

        $this->validate($request, $rules);

        $activity->activity_name = $request->input('activity_name', $activity->activity_name);
        $activity->location = $request->input('location', $activity->location);
        $activity->including_food = $request->input('food_included', $activity->including_food);
        $activity->description = $request->input('description', $activity->description);
        $activity->start_time = $request->input('start_time', $activity->start_time);
        $activity->end_time = $request->input('end_time', $activity->end_time);
        $activity->price = $request->input('price', $activity->price);
        $activity->maximum_number_of_participants = $request->input('maximum_number_of_participants', $activity->maximum_number_of_participants);
        $activity->minimum_number_of_participants = $request->input('minimum_number_of_participants', $activity->minimum_number_of_participants);
        $activity->image = $request->input('image', $activity->image);

        // Handle the employee_only field
        $activity->employees_only = $request->has('employee_only');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->hashName();
            $activity->image = $filename;
        }

        $activity->save();

        session()->flash('success', 'De activiteit is geüpdate!');
        return redirect()->route('dashboard');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activity = activities::find($id);
        if ($activity) {
            $activity->delete();
        }

        session()->flash('success', 'De activiteit is verwijderd!');
        return redirect()->route('dashboard');
    }

    public function dashboardSearch(Request $request)
    {
        $validatedData = $request->validate([
            'query' => 'required|string|min:3', // Validate the input string
        ]);

        $query = $validatedData['query'];

        $activities = activities::Where('activity_name', 'LIKE', '%' . $query . '%')->get();

        if (Auth::user()->role === 'admin' || Auth::user()->role === 'owner'  ) {
            return view('dashboard', ['activities' => $activities]);
        } else {
            return redirect()->route('index', ['activities' => $activities]);
        }

        // return dd($activityList);
    }
}
