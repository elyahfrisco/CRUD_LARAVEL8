<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;
    protected $table = "article";
    protected $primaryKey = "id_article";

    public $timestamps = false;
    protected $fillable = [
        'libelle',
        'quantite',
        'prix',
        'id_famille'
    ];

}
