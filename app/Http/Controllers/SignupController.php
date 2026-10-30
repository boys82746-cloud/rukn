<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function signup(SignupRequest $request)
    {
        // The password is hashed automatically by the 'hashed' cast in the User model
        $user = User::create($request->validated());

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
