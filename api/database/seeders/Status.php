<?php

namespace Database\Seeders;

use App\Models\Status as ModelsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = [
            ['description' => 'Ativo'],
            ['description' => 'Inativo'],
            ['description' => 'Excluído']
        ];

        foreach ($store as $key => $val) {
            $status = ModelsStatus::where('description', $val['description'])->get();

            if (count($status) == 0) {
                ModelsStatus::create($val);
            }
        };
    }
}
