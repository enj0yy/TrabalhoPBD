<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'senha',
        'nome',
        'data_nascimento',
        'nome_usuario',
        'foto',
        'biografia',
    ];

    protected $hidden = [
        'senha',
    ];

    protected $table = 'usuarios';
    public $timestamps = false;

    public function getAuthPassword(){  
        return $this->senha;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function publicacoes(): HasMany
    {
        return $this->hasMany(Publicacao::class, 'id_usuario_criador', 'id');	
    }

    public function curtidas(): BelongsToMany
    {
        return $this->belongsToMany(Publicacao::class, 'curtidas', 'id_publicacao', 'id_usuario');
    }

    public function seguidores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'seguidores', 'id_usuario_seguido', 'id_usuario_seguidor');
    }

    public function seguindo(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'seguidores', 'id_usuario_seguidor', 'id_usuario_seguido');
    }
}
