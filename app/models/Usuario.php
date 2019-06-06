<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tb_usuario';
    protected $primaryKey = 'cd_usuario';

    protected $fillable = [
        'nm_usuario',
        'nm_email',
        'nm_senha',
        'fl_ativo'
    ];

}
