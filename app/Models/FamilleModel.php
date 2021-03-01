<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilleModel extends Model
{
    use HasFactory;
    protected $table = "famille";
    protected $primaryKey = "id_famille";

    public $timestamps = false;
    protected $fillable = [
        'famille'
    ];
}
