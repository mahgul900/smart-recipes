<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
{
    $user = $request->user();

    $rules = [
        'name' => ['required', 'string', 'max:255'],
    ];

    if (!$user->is_admin) {
        $rules['email'] = ['required', 'email', 'max:255'];
    }

    if ($request->filled('password')) {
        $rules['password'] = ['required', 'confirmed', 'min:8'];
    }

    $request->validate($rules);

    $user->name = $request->name;

    if (!$user->is_admin) {
        $user->email = $request->email;
    }

    if ($request->filled('password')) {
        $user->password = \Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated!');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        Auth::logout();

        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
