<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    use HasFactory;

    protected $table = "type";
    protected $primaryKey = "id_type";

    public $timestamps = false;
    protected $fillable = [
        'libelle_type'
    ];
}
