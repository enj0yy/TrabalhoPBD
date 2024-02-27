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
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'data_nascimento' => ['required', 'date'],
            'nome_usuario' => ['required', 'string', 'max:255', 'unique:'.User::class],
        ]);

        $file = $request->file('foto');
        $filename = date('YmdHi').$request->nome_usuario . '.' . $file->getClientOriginalExtension();
        $file-> move(public_path('img'), $filename);

        $user = User::create([
            'nome' => $request->name,
            'email' => $request->email,
            'senha' => $request->password,
            'data_nascimento' => $request->data_nascimento,
            'nome_usuario' => $request->nome_usuario,
            'foto' => $filename,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
