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
            ->where('licitacoes.status', 1)
            ->join('empresas', 'licitacoes.empresa', '=', 'cidades.id')
            ->join('modalidades', 'licitacoes.modalidade', '=', 'modalidades.id')
            ->orderByDesc('licitacoes.id')
            ->get();

        return $licitacoes;
    }

    public function post(Request $request)
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

    public function put(Request $request)
    {
        try {
            $update = $this->model::where('status', '=', 1)
                ->findOrFail($request->id);

            return $update
                ->update($request->all());
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
