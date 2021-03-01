<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use App\Models\FamilleModel;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        return view('pages.article');
    }

    public function insert(Request $request){
        $article = array(
        'libelle' => $request->input('libelle'),
        'quantite' => $request->input('quantite'),
        'prix' => $request->input('prix'),
        'id_famille' => $request->input('id_famille'),

        );
        echo json_encode(ArticleModel::create($article));
    }

    public function list(Request $request){
        $article = ArticleModel::all();
        foreach($article as $clt){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$clt->id_article."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$clt->id_article."')\" >Supprimer</a>";
            $output['data'][] = array(
                'libelle' => $clt->libelle,
                'quantite' => $clt->quantite,
                'prix' => $clt->prix,
                'id_famille' => FamilleModel::find($clt->id_famille)->famille,
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getArticle(Request $request){
        $id = $request->input('id_article');
        $clt = ArticleModel::find($id);
        echo json_encode($clt);
    }

    public function update(Request $request){
        $id = $request->input('id_article');
        $client = array(
            'libelle' => $request->input('libelle'),
            'quantite' => $request->input('quantite'),
            'prix' => $request->input('prix'),
            'id_famille' => $request->input('id_famille')
            );
        echo json_encode(ArticleModel::where('id_article', $id)->update($client));
    }

    public function delete(Request $request){
        $id = $request->input('id_article');
        echo json_encode(ArticleModel::where('id_article', $id)->delete());
    }

    public function idFamille(Request $request){
        $entreprise = FamilleModel::all();
        $idEntreprise = "
        <td>Designation :</td>
        <td><select class=\"form-control\" name=\"id_famille\" id=\"idFamille\">";
        foreach($entreprise as $entre){
            $idEntreprise .= "<option value=\"$entre->id_famille\">$entre->famille</option>";
        }
        $idEntreprise.= "</select><td>";
        echo json_encode($idEntreprise);
    }
}
