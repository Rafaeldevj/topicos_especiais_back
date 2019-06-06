<?php

namespace App\Http\Controllers;

use App\models\Grupo;
use App\models\UsuarioGrupo;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{

    private $model;
    private $modelGrupo;
    private $modelUsuarioGrupo;

    public function __construct(Usuario $usuario, Grupo $grupo, UsuarioGrupo $modelUsuarioGrupo)
    {
        $this->model = $usuario;
        $this->modelGrupo = $grupo;
        $this->modelUsuarioGrupo = $modelUsuarioGrupo;
    }

    public function findAll()
    {
        $usuarios = $this->model->all();



        return response()->json($usuarios);
    }

    public function findById($id)
    {
        $usuario = $this->model->select('cd_usuario', 'nm_usuario', 'nm_email', 'fl_ativo')
            ->where('cd_usuario', '=', $id)
            ->get();

        $grupos = $this->model->join('tb_usuario_grupo', 'tb_usuario.cd_usuario', '=', 'tb_usuario_grupo.cd_usuario')
            ->where('tb_usuario_grupo.cd_usuario', '=', $usuario[0]['cd_usuario'])
            ->get();

        $grupo = $this->modelGrupo->find($grupos[0]['cd_grupo']);

        $resposta = array('usr' => $usuario, 'grupo' => $grupo);

        return response()->json($resposta);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $data['nm_senha'] = md5($data['nm_senha']);

        $usuario = $this->model->create($data);

        $this->modelUsuarioGrupo->insert(['cd_usuario' => $usuario->cd_usuario, 'cd_grupo' => $data['grupo']]);

        return response()->json($usuario);

    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $usuario = $this->model->where('cd_usuario', $id)->update(
            ['nm_usuario' => $data['nm_usuario'], 'nm_email' => $data['nm_email'], 'fl_ativo' => $data['fl_ativo'] ]);

        $this->modelUsuarioGrupo->where('cd_usuario', $id)->update(['cd_grupo' => $data['grupo']]);

        return response()->json($usuario);
    }

    public function active($id)
    {
        $usuario = $this->model->find($id);

        if($usuario['fl_ativo'] == 'S') {
            $user = $this->model->find($id)->update(['fl_ativo' => 'N']);
        } else {
            $user = $this->model->find($id)->update(['fl_ativo' => 'S']);
        }

        return response()->json($usuario['fl_ativo']);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $email = $data['nm_email'];
        $senha = md5($data['nm_senha']);

        $user = $this->model->select('cd_usuario', 'nm_usuario', 'nm_email', 'fl_ativo', 'created_at')
        ->where('nm_email', '=', $email)
        ->where('nm_senha', '=', $senha)
        ->get();

        if(count($user) >= 1) {

            $grupos = $this->model->join('tb_usuario_grupo', 'tb_usuario.cd_usuario', '=', 'tb_usuario_grupo.cd_usuario')
                ->where('tb_usuario_grupo.cd_usuario', '=', $user[0]['cd_usuario'])
                ->get();

            if (count($grupos) > 0) {
                $grupo = $this->modelGrupo->find($grupos[0]['cd_grupo']);
            } else {
                $grupo = 0;
            }

            if ($user[0]['fl_ativo'] == 'S') {
                return array('cod' => 1, 'usr' => $user, 'grupo' => $grupo);
            }
            else {
                return array('cod' => 3, 'msg' => 'Usuário inativo!');
            }

        } else {
            return array('cod' => 2, 'msg' => 'Usuário não encontrado!');
        }

    }
}
