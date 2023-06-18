<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;

    protected $fillable = array(
        "status",
        "cnpj",
        "name_fantasy",
        "corporate_reason",
        "address",
        "cell_phone",
        "email"
    );

    protected $table = "empresas";
    protected $primaryKey = "id";
}
