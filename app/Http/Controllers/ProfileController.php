<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tutor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

//        if ($request->user()->isDirty('username')) {
//            $request->user()->email_verified_at = null;
//        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
//        $user = $request->user();
//        $validatedData = $request->validated();
//
//        // Only update if the data has actually changed
//        if ($validatedData['name'] !== $user->name) {
//            $user->name = $validatedData['name'];
//        }
//
//        if ($validatedData['username'] !== $user->username) {
//            $user->username = $validatedData['username'];
//        }
//
//        $user->save();
//
//        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
