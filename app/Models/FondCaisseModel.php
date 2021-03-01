<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondCaisseModel extends Model
{
    use HasFactory;

    protected $table = "fond_caisse";
    protected $primaryKey = "id_fond";

    public $timestamps = false;
    protected $fillable = [
        'total_fond',
        'date'
    ];
}
