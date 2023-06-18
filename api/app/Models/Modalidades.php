<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidades extends Model
{
    use HasFactory;

    protected $fillable = array(
        "status",
        "description"
    );

    protected $table = "modalidades";
    protected $primaryKey = "id";
}
