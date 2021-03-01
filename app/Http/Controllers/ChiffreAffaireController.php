<?php

namespace App\Http\Controllers;

use App\Models\ChiffreAffaireModel;
use Illuminate\Http\Request;

class ChiffreAffaireController extends Controller
{
    public function index(){
        return view('pages.chiffreAffaire');
    }

    public function insert(Request $request){
        $ca = array(
        'total_ca' => $request->input('total_ca'),
        'date_ca' => $request->input('date_ca'),
        );
        echo json_encode(ChiffreAffaireModel::create($ca));        
    }

    public function list(Request $request){
        $chiffreAffaire = ChiffreAffaireModel::all();
        foreach($chiffreAffaire as $ca){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$ca->id_ca."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$ca->id_ca."')\" >Supprimer</a>";
            $output['data'][] = array(
                'total_ca' => $ca->total_ca,
                'date_ca' => $ca->date_ca,
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getCA(Request $request){
        $id = $request->input('id_ca');
        $ca = ChiffreAffaireModel::find($id);
        echo json_encode($ca);
    }

    public function update(Request $request){
        $id = $request->input('id_ca');
        $ca = array(
            'total_ca' => $request->input('total_ca'),
            'date_ca' => $request->input('date_ca'),
            );
        echo json_encode(ChiffreAffaireModel::where('id_ca', $id)->update($ca));
    }

    public function delete(Request $request){
        $id = $request->input('id_ca');
        echo json_encode(ChiffreAffaireModel::where('id_ca', $id)->delete());
    }
}
