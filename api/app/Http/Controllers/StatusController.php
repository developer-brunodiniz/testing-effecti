<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Status();
    }

    public function index(Request $request)
    {
        $status = $this->model
            ->orderBy('status.description')
            ->get();

        return $status;
    }

    public function post(Request $request)
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

    public function put(Request $request)
    {
        try {
            $update = $this->model::findOrFail($request->id);

            return $update
                ->update($request->all());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try {

            $delete = $this->model::findOrFail($request->id);

            return $delete
                ->delete();
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
