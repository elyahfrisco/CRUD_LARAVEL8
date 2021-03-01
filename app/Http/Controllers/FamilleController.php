<?php

namespace App\Http\Controllers;

use App\Models\FamilleModel;
use Illuminate\Http\Request;

class FamilleController extends Controller
{
    public function index(){
        return view("pages.famille");
    }
    public function insert(Request $request){
        $famille = array(
        'famille' => $request->input('famille'),
        );
        echo json_encode(FamilleModel::create($famille));
    }

    public function list(Request $request){
        $famille = FamilleModel::all();
        foreach($famille as $fam){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$fam->id_famille."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$fam->id_famille."')\" >Supprimer</a>";
            $output['data'][] = array(
                'famille' => $fam->famille,
                'action' => $action

            );
        }
        echo json_encode($output);
    }

    public function getFamille(Request $request){
        $id = $request->input('id_famille');
        $fond = FamilleModel::find($id);
        echo json_encode($fond);
    }

    public function update(Request $request){
        $id = $request->input('id_famille');
        $fond = array(
            'famille' => $request->input('famille'),

            );
        echo json_encode(FamilleModel::where('id_famille', $id)->update($fond));
    }

    public function delete(Request $request){
        $id = $request->input('id_famille');
        echo json_encode(FamilleModel::where('id_famille', $id)->delete());
    }
}
