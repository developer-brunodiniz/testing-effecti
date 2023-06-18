<?php

namespace Database\Seeders;

use App\Models\Modalidades as ModelsModalidades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Modalidades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = [
            [
                'description' => 'Lei 8.666/93: Concorrência',
                'status' => 1
            ],
            [
                'description' => 'Lei 8.666/93: Convite',
                'status' => 1
            ],
            [
                'description' => 'Lei 14.133/2021 Concorrência',
                'status' => 1
            ],
            [
                'description' => 'Lei 14.133/2021 Convite',
                'status' => 1
            ],
            [
                'description' => 'Tomada de Preços',
                'status' => 1
            ],
            [
                'description' => 'Concurso',
                'status' => 1
            ],
            [
                'description' => 'Leilão',
                'status' => 1
            ],
            [
                'description' => 'Diálogo Competitivo',
                'status' => 1
            ]
        ];

        foreach ($store as $key => $val) {
            $modalidades = ModelsModalidades::where('description', $val['description'])->get();

            if (count($modalidades) == 0) {
                ModelsModalidades::create($val);
            }
        };
    }
}
