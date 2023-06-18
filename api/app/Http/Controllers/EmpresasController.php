<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Empresas();
    }

    public function index(Request $request)
    {
        $empresas = $this->model
            ->where('empresas.status', 1)
            ->orderByDesc('empresas.id')
            ->get();

        return $empresas;
    }

    public function post(Request $request)
    {
        try {
            $params = [
                'status' => 1,
                'cnpj' => $request->cnpj,
                'name_fantasy' => $request->name_fantasy,
                'corporate_reason' => $request->corporate_reason,
                'address' => $request->address,
                'cell_phone' => $request->cell_phone,
                'email' => $request->email
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
