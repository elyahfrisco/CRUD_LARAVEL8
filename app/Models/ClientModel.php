<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;

    protected $table = "client";
    protected $primaryKey = "id_client";

    public $timestamps = false;
    protected $fillable = [
        'nom_client',
        'cin',
        'tel',
        'email',
        'adresse',
        'id_entreprise'
    ];
}
