<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\activities;
use App\Models\allowedips;
use App\Models\contact;
use App\Models\opentime;
use App\Models\ordertickets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'dashboard',
            'userdashboard',
            'register',
            'store',
            'editUser',
            'updateUser',
            'destroyUser'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'owner'  ) {
            return view('register');
        } else {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Je moet ingelogd zijn om te registreren.',
                ])->onlyInput(
                    'email'
                );
        }
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('userdashboard')
            ->withSuccess('Account aangemaakt!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('Je bent ingelogd!');
        }

        return back()->withErrors([
            'email' => 'Deze inloggegevens zijn niet bij ons bekend.',
        ])->onlyInput('email');
    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {
            $activities = activities::all();
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'owner'  ) {
                return view('dashboard', ['activities' => $activities]);
            } else {
                return redirect()->route('index', ['activities' => $activities]);
            }
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'U moet ingelogd zijn om het dashboard te bekijken.',
            ])->onlyInput('email');
    }

    public function userdashboard()
    {
        if (Auth::check()) {
            $users = User::all();
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'owner'  ) {
                return view('userdashboard', ['users' => $users]);
            } else {
                return redirect()->route('index');
            }
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'U moet ingelogd zijn om het dashboard te bekijken.',
            ])->onlyInput('email');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = ['admin', 'user'];

        return view('edit_user', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('userdashboard')->with('success', 'De gebruiker is geüpdate.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('userdashboard')->with('success', 'De gebruiker is verwijderd.');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Je bent uitgelogd!');
    }
}
