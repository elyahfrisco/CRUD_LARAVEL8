<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteClientModel extends Model
{
    use HasFactory;
    protected $table = "compte_client";
    protected $primaryKey = "num_compte";

    public $timestamps = false;
    protected $fillable = [
        'total',
        'id_client'
    ];
}
