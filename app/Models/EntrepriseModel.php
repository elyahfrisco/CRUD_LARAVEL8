<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepriseModel extends Model
{
    use HasFactory;

    protected $table = "entreprise";
    protected $primaryKey = "id_entreprise";

    public $timestamps = false;
    protected $fillable = [
        'nom_entreprise'
    ];
}
