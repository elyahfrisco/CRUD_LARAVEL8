<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\ChiffreAffaireController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteClientController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FondCaisseController;
use App\Http\Controllers\MouvementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages/menu');
})->name('index');

Route::group(['prefix' => 'fondCaisse'], function(){
    Route::get('/', [FondCaisseController::class, 'index'])->name("liste_fondCaisse");
    Route::group(['prefix' => 'fondCaisse'], function(){
        Route::post('ajouter', [FondCaisseController::class, 'insert'])->name("ajouter_fondCaisse");
        Route::get('lister', [FondCaisseController::class, 'list'])->name("lister_fondCaisse");
        Route::post('getFond', [FondCaisseController::class, 'getFond'])->name("getFondById");
        Route::post('modifier', [FondCaisseController::class, 'update'])->name("modifier_fondCaisse");
        Route::post('supprimer', [FondCaisseController::class, 'delete'])->name("supprimer_fondCaisse");
    });
});

Route::group(['prefix' => 'famille'], function () {
    Route::get('/', [FamilleController::class, 'Index'])->name("liste_famille");
    Route::group(['prefix' => 'famille'], function(){
        Route::post('ajouter', [FamilleController::class, 'insert'])->name("ajouter_famille");
        Route::get('lister', [FamilleController::class, 'list'])->name("lister_famille");
        Route::post('getFamille', [FamilleController::class, 'getFamille'])->name("getfamilleById");
        Route::post('modifier', [FamilleController::class, 'update'])->name("modifier_famille");
        Route::post('supprimer', [FamilleController::class, 'delete'])->name("supprimer_famille");
    });

});

Route::group(['prefix' => 'client'], function(){
    Route::get('/', [ClientController::class, 'index'])->name("liste_client");
    Route::group(['prefix' => 'client'], function(){
        Route::post('ajouter', [ClientController::class, 'insert'])->name("ajouter_client");
        Route::get('lister', [ClientController::class, 'list'])->name("lister_client");
        Route::get('getId', [ClientController::class, 'idEntreprise'])->name("getIdEntreprise");
        Route::post('getFond', [ClientController::class, 'getClient'])->name("getClientById");
        Route::post('modifier', [ClientController::class, 'update'])->name("modifier_client");
        Route::post('supprimer', [ClientController::class, 'delete'])->name("supprimer_client");
    });
});

Route::group(['prefix' => 'article'], function(){
    Route::get('/', [ArticleController::class, 'index'])->name("liste_article");
    Route::group(['prefix' => 'article'], function(){
        Route::post('ajouter', [ArticleController::class, 'insert'])->name("ajouter_article");
        Route::get('lister', [ArticleController::class, 'list'])->name("lister_article");
        Route::get('getId', [ArticleController::class, 'idFamille'])->name("getIdFamille");
        Route::post('getFond', [ArticleController::class, 'getArticle'])->name("getArticleById");
        Route::post('modifier', [ArticleController::class, 'update'])->name("modifier_article");
        Route::post('supprimer', [ArticleController::class, 'delete'])->name("supprimer_article");
    });
});


Route::group(['prefix' => 'entreprise'], function(){
    Route::get('/', [EntrepriseController::class, 'index'])->name("liste_entreprise");
    Route::group(['prefix' => 'entreprise'], function(){
        Route::post('ajouter', [EntrepriseController::class, 'insert'])->name("ajouter_entreprise");
        Route::get('lister', [EntrepriseController::class, 'list'])->name("lister_entreprise");
        Route::post('getFond', [EntrepriseController::class, 'getEntreprise'])->name("getEntrepriseById");
        Route::post('modifier', [EntrepriseController::class, 'update'])->name("modifier_entreprise");
        Route::post('supprimer', [EntrepriseController::class, 'delete'])->name("supprimer_entreprise");
    });
});

Route::group(['prefix' => 'chiffreAffaire'], function(){
    Route::get('/', [ChiffreAffaireController::class, 'index'])->name("liste_chiffreAffaire");
    Route::group(['prefix' => 'chiffreAffaire'], function(){
        Route::post('ajouter', [ChiffreAffaireController::class, 'insert'])->name("ajouter_chiffreAffaire");
        Route::get('lister', [ChiffreAffaireController::class, 'list'])->name("lister_chiffreAffaire");
        Route::post('getFond', [ChiffreAffaireController::class, 'getCA'])->name("getCAById");
        Route::post('modifier', [ChiffreAffaireController::class, 'update'])->name("modifier_chiffreAffaire");
        Route::post('supprimer', [ChiffreAffaireController::class, 'delete'])->name("supprimer_chiffreAffaire");
    });
});

Route::group(['prefix' => 'mouvement'], function(){
    Route::get('/', [MouvementController::class, 'index'])->name("liste_mouvement");
    Route::group(['prefix' => 'mouvement'], function(){
        Route::post('ajouter', [MouvementController::class, 'insert'])->name("ajouter_mouvement");
        Route::get('lister', [MouvementController::class, 'list'])->name("lister_mouvement");
        Route::get('getId', [MouvementController::class, 'idType'])->name("getIdType");
        Route::post('getFond', [MouvementController::class, 'getMouvement'])->name("getMouvementById");
        Route::post('modifier', [MouvementController::class, 'update'])->name("modifier_mouvement");
        Route::post('supprimer', [MouvementController::class, 'delete'])->name("supprimer_mouvement");
    });
});

Route::group(['prefix' => 'compteClient'], function(){
    Route::get('/', [CompteClientController::class, 'index'])->name("liste_compteClient");
    Route::group(['prefix' => 'compteClient'], function(){
        Route::post('ajouter', [CompteClientController::class, 'insert'])->name("ajouter_compteClient");
        Route::get('lister', [CompteClientController::class, 'list'])->name("lister_compteClient");
        Route::get('getId', [CompteClientController::class, 'idClient'])->name("getIdClient");
        Route::post('getFond', [CompteClientController::class, 'getCompteClient'])->name("getCompteClienttById");
        Route::post('modifier', [CompteClientController::class, 'update'])->name("modifier_compteClient");
        Route::post('supprimer', [CompteClientController::class, 'delete'])->name("supprimer_compteClient");
    });
});
