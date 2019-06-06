<?php
/**
 * Created by PhpStorm.
 * User: rafa_
 * Date: 05/06/2019
 * Time: 09:45
 */

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'tb_grupo';
    protected $primaryKey = 'cd_grupo';

    protected $fillable = [
        'nm_grupo',
    ];

    public $timestamps = false;
}