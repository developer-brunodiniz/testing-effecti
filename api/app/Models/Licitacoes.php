<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacoes extends Model
{
    use HasFactory;

    protected $fillable = array(
        "status",
        "empresa",
        "modalidade",
        "description"
    );

    protected $table = "licitacoes";
    protected $primaryKey = "id";
}
