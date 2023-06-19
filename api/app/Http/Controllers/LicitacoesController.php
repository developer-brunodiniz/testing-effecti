<?php

namespace App\Http\Controllers;

use App\Models\Licitacoes;
use Illuminate\Http\Request;

class LicitacoesController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Licitacoes();
    }

    public function index(Request $request)
    {
        $licitacoes = $this->model
            ->select('licitacoes.id', 'licitacoes.description', 'modalidades.id as modalidade_id', 'modalidades.description as modalidade_description', 'empresas.id as empresa_id', 'empresas.name_fantasy as empresa_nomefantasia')
            ->where('licitacoes.status', 1)
            ->join('empresas', 'licitacoes.empresa', '=', 'empresas.id')
            ->join('modalidades', 'licitacoes.modalidade', '=', 'modalidades.id')
            ->orderByDesc('licitacoes.id')
            ->get();

        return $licitacoes;
    }

    public function insert(Request $request)
    {
        try {
            $params = [
                'status' => 1,
                'empresa' => $request->empresa,
                'modalidade' => $request->modalidade,
                'description' => $request->description
            ];

            return $this->model
                ->create($params);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {
            $update = $this->model::where('status', '=', 1)
                ->findOrFail($request->id);

            $params = [
                'id' => $request->id,
                'empresa' => $request->empresa,
                'modalidade' => $request->modalidade,
                'description' => $request->description
            ];

            return $update
                ->update($params);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try {

            return $this->model::where('id', $request->id)
                ->update(["status" => 3]);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
