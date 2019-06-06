<?php
/**
 * Created by PhpStorm.
 * User: rafa_
 * Date: 05/06/2019
 * Time: 10:00
 */

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class UsuarioGrupo extends Model
{

    protected $table = 'tb_usuario_grupo';
    protected $primaryKey = 'cd_usuario_grupo';

    protected $fillable = [
        'cd_usuario',
        'cd_grupo',
    ];

    public $timestamps = false;
}