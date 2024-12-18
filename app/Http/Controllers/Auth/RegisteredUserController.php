<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Determine role based on username
        $role = str_contains($request->username, '@admin') ? 'tutor' : 'student';

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $role, // Add role assignment
        ]);

        // Create tutor record only if the role is tutor
        if ($role === 'tutor') {
            Tutor::create([
                'tutor_name' => $request->name,
                'tutor_id' => $request->username,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        return redirect(
            $role === 'tutor'
                ? route('dashboard', absolute: false)
                : route('student/dashboard', absolute: false)
        );
    }
}
