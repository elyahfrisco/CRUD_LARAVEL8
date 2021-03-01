<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementModel extends Model
{
    use HasFactory;
    protected $table = "mouvement";
    protected $primaryKey = "id_mouvement";

    public $timestamps = false;
    protected $fillable = [
        'date_mouvement',
        'motif_mouvement',
        'montant',
        'id_type'
    ];
}
