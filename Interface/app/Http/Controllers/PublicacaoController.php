<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curtida;
use Illuminate\Support\Facades\Auth;
use App\Models\Publicacao;
use Inertia\Inertia;
use DB;

class PublicacaoController extends Controller
{
    public function show(String $id_publicacao)
    {
        $publicacao = Publicacao::with('comentarios')
        ->with('usuario')
        ->with('curtidas')
        ->find($id_publicacao);


        $publicacao->curtida = $publicacao->curtidas()->where('id_usuario', auth()->user()->id)->first();
        $publicacao->curtidasCount = $publicacao->curtidas()->count();
        $publicacao->comentariosCount = $publicacao->comentarios()->count();

        return Inertia::render('Publicacao', [
            'publicacao' => $publicacao,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'conteudo' => 'required'
        ]);

        $publicacao = new Publicacao();
        $publicacao->id_usuario_criador = Auth::user()->id;
        $publicacao->conteudo = $request->conteudo;
        $publicacao->data_criacao = now();
        $publicacao->save();

        response()->json(['success' => 'success'], 200);
    }
    
    public function like(String $id_publicacao)
    {
        $curtida = Curtida::where('id_usuario', Auth::user()->id)
            ->where('id_publicacao', $id_publicacao)
            ->first();
        
            try {
                if ($curtida) {
                    $curtida->delete();
                } else {
                    $curtida = new Curtida();
                    $curtida->id_usuario = Auth::user()->id;
                    $curtida->id_publicacao = $id_publicacao;
                    $curtida->data_interacao = now();
                    $curtida->save();
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    
        response()->json(['success' => 'success'], 200);
    }

    public function comment(Request $request, String $id_publicacao)
    {
        $request->validate([
            'comentario' => 'required'
        ]);

        DB::table('comentarios')->insert([
            'id_publicacao' => $id_publicacao,
            'id_usuario' => Auth::user()->id,
            'comentario' => $request->comentario,
            'data_interacao' => now()
        ]);

        response()->json(['success' => 'success'], 200);
    }

}
