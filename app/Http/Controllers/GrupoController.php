<?php
/**
 * Created by PhpStorm.
 * User: rafa_
 * Date: 05/06/2019
 * Time: 09:43
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{
    private $model;

    public function __construct(Grupo $grupo)
    {
        $this->model = $grupo;
    }

    public function findAll()
    {
        $grupos = $this->model->all();
        return response()->json($grupos);
    }

    public function findById($id)
    {
        $grupo = $this->model->find($id);
        return response()->json($grupo);
    }

    public function save(Request $request)
    {

        $grupo = $this->model->create($request->all());
        return response()->json($grupo);

    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $grupo = $this->model->find($id)->update($data);
        return response()->json($grupo);
    }

    public function delete($id)
    {

        $grupo = $this->model->find($id)->delete();
        return response()->json(null);
    }
}