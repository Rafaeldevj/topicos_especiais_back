<?php
/**
 * Created by PhpStorm.
 * User: rafa_
 * Date: 05/06/2019
 * Time: 10:02
 */

namespace App\Http\Controllers;

use App\models\UsuarioGrupo;
use Illuminate\Http\Request;

class UsuarioGrupoController extends Controller
{
    
    private $model;

    public function __construct(UsuarioGrupo $usarioGrupo)
    {
        $this->model = $usarioGrupo;
    }

    public function findAll()
    {
        $usarioGrupos = $this->model->all();
        return response()->json($usarioGrupos);
    }

    public function findById($id)
    {
        $usarioGrupo = $this->model->find($id);
        return response()->json($usarioGrupo);
    }

    public function save(Request $request)
    {

        $usarioGrupo = $this->model->create($request->all());
        return response()->json($usarioGrupo);

    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $usarioGrupo = $this->model->find($id)->update($data);
        return response()->json($usarioGrupo);
    }

    public function delete($id)
    {

        $usarioGrupo = $this->model->find($id)->delete();
        return response()->json(null);
    }
    
}