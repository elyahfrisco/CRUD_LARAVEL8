<?php

namespace App\Http\Controllers;

use App\Models\MouvementModel;
use App\Models\TypeModel;
use Illuminate\Http\Request;

class MouvementController extends Controller
{
    public function index(){
        return view('pages.mouvement');
    }

    public function insert(Request $request){
        $mouvement = array(
        'date_mouvement' => $request->input('date_mouvement'),
        'motif_mouvement' => $request->input('motif_mouvement'),
        'montant' => $request->input('montant'),
        'id_type' => $request->input('id_type')
        );
        echo json_encode(MouvementModel::create($mouvement));        
    }

    public function list(Request $request){
        $mouvement = MouvementModel::all();
        foreach($mouvement as $mvt){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$mvt->id_mouvement."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$mvt->id_mouvement."')\" >Supprimer</a>";
            $output['data'][] = array(
                'date_mouvement' => $mvt->date_mouvement,
                'motif_mouvement' => $mvt->motif_mouvement,
                'montant' => $mvt->montant,
                'id_type' => TypeModel::find($mvt->id_type)->libelle_type,
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getMouvement(Request $request){
        $id = $request->input('id_mouvement');
        $mvt = MouvementModel::find($id);
        echo json_encode($mvt);
    }

    public function update(Request $request){
        $id = $request->input('id_mouvement');
        $mouvement = array(
            'date_mouvement' => $request->input('date_mouvement'),
            'motif_mouvement' => $request->input('motif_mouvement'),
            'montant' => $request->input('montant'),
            'id_type' => $request->input('id_type')
            );
        echo json_encode(MouvementModel::where('id_mouvement', $id)->update($mouvement));
    }

    public function delete(Request $request){
        $id = $request->input('id_mouvement');
        echo json_encode(MouvementModel::where('id_mouvement', $id)->delete());
    }

    public function idType(){
        $type = TypeModel::all();
        $idType = "
        <td>Type :</td>
        <td><select class=\"form-control\" name=\"id_type\" id=\"idType\">";
        foreach($type as $tp){
            $idType .= "<option value=\"$tp->id_type\">$tp->libelle_type</option>";
        }
        $idType.= "</select><td>";
        echo json_encode($idType);
    }
}
