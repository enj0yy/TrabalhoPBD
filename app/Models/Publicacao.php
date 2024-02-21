<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Publicacao extends Model
{
    protected $table = 'publicacoes';
    
    protected $dates = [
        'data_criacao'
    ];

    public $timestamps = false;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario_criador', 'id');
    }

    public function curtidas(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'curtidas', 'id_publicacao', 'id_usuario');
    }

    public function comentarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comentarios', 'id_publicacao', 'id_usuario');
    }
}
