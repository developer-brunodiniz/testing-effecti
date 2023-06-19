<?php

namespace App\Http\Controllers;

use App\Models\Modalidades;
use Illuminate\Http\Request;

class ModalidadesController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Modalidades();
    }

    public function index(Request $request)
    {
        $modalidades = $this->model
            ->where('modalidades.status', 1)
            ->orderBy('modalidades.description')
            ->get();

        return $modalidades;
    }

    public function insert(Request $request)
    {
        try {
            $params = [
                'status' => 1,
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
