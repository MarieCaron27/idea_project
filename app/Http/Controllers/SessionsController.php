<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/auth/login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string','email','max:255'],
            'password' => ['required', Password::default()]
        ]);

        Auth::attempt($validated);

        return redirect('/ideas');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
