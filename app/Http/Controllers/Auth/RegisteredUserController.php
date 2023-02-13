<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date', 'before:-18 years'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'name.max' => 'Il nome non può superare 255 caratteri',
            'surname.max' => 'Il cognome non può superare 255 caratteri',
            'birthdate.before' => 'Per iscriverti devi essere maggiorenne',
            'email.email' => 'Inserisci una email valida',
            'email.unique' => "L'email è già stata usata",
            'email.required' => "L'email è obbligatoria",
            'password.required' => 'La password è obbligatoria'
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
