<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Publicacao;
use DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function show(String $nome_usuario): Response
    {
        $user = User::where('nome_usuario', $nome_usuario)->with("seguidores")->with("seguindo")->firstOrFail();
        $user->seguido = $user->seguidores()->where('id_usuario_seguidor', auth()->user()->id)->first();

        $user->seguidoresCount = DB::table('seguidores')
        ->select('seguidores.*')
        ->where('id_usuario_seguido', '=', $user->id)
        ->count();

        $user->seguindoCount = DB::table('seguidores')
        ->select('seguidores.*')
        ->where('id_usuario_seguidor', '=', $user->id)
        ->count();

        $publicacoes = Publicacao::with('usuario')
        ->with('curtidas')->with('comentarios')
        ->where('id_usuario_criador', $user->id)
        ->orderBy('data_criacao', 'desc')->get();

        foreach ($publicacoes as $publicacao) {
            $publicacao->curtida = $publicacao->curtidas()->where('id_usuario', auth()->user()->id)->first();
            $publicacao->curtidasCount = $publicacao->curtidas()->count();
            $publicacao->comentariosCount = $publicacao->comentarios()->count();
        }


        return Inertia::render('Profile/Show', [
            'user' => $user,
            'publicacoes' => $publicacoes,
        ]);
    }

    public function follow(int $id_usuario)
    {
        $user = User::findOrFail($id_usuario);

        if (Auth::user()->seguindo()->where('id_usuario_seguido', $user->id)->exists()) {
            Auth::user()->seguindo()->detach($user->id);
        } else {
            Auth::user()->seguindo()->attach($user->id, ['data_interacao' => now()]);

        }

        response()->json(['success' => 'success'], 200);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:usuarios,email,'.$request->user()->id],
            'biografia' => ['nullable', 'max:255'],
        ]);

        $request->user()->fill($request->only('nome', 'email', 'biografia'));

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
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
