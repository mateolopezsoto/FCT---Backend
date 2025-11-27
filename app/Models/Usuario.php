<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'Usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'apelidos',
        'correo',
        'contrasinal',
        'telefono',
        'id_rol'
    ];

    protected $hidden = [
        'contrasinal',
    ];

    // Para que Laravel no toque los nombres automáticos
    protected function setKeysForSaveQuery($query)
    {
        return $query->where('id_usuario', $this->getKey());
    }
}