<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiffreAffaireModel extends Model
{
    use HasFactory;
    protected $table = "chiffre_affaire";
    protected $primaryKey = "id_ca";

    public $timestamps = false;
    protected $fillable = [
        'total_ca',
        'date_ca'
    ];
}
