<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Publicacao;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $publicacoes = Publicacao::with('usuario')
        ->with('curtidas')->with('comentarios')
        ->orderBy('data_criacao', 'desc')->paginate(10);

        foreach ($publicacoes as $publicacao) {
            $publicacao->curtida = $publicacao->curtidas()->where('id_usuario', auth()->user()->id)->first();
            $publicacao->curtidasCount = $publicacao->curtidas()->count();
            $publicacao->comentariosCount = $publicacao->comentarios()->count();
        }

        if ($request->wantsJson())
        {
            return $publicacoes;
        }
        

        return Inertia::render('Home', [
            'publicacoes' => $publicacoes
        ]);
    }
}
