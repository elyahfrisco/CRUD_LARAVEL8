<?php

namespace App\Http\Controllers;

use App\Models\EntrepriseModel;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index(){
        return view('pages.entreprise');
    }

    public function insert(Request $request){
        $entre = array(
        'nom_entreprise' => $request->input('nom_entreprise')
        );
        echo json_encode(EntrepriseModel::create($entre));        
    }

    public function list(Request $request){
        $entreprise = EntrepriseModel::all();
        foreach($entreprise as $entre){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$entre->id_entreprise."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$entre->id_entreprise."')\" >Supprimer</a>";
            $output['data'][] = array(
                'nom_entreprise' => $entre->nom_entreprise,
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getEntreprise(Request $request){
        $id = $request->input('id_entreprise');
        $entre = EntrepriseModel::find($id);
        echo json_encode($entre);
    }

    public function update(Request $request){
        $id = $request->input('id_entreprise');
        $entre = array(
            'nom_entreprise' => $request->input('nom_entreprise')
            );
        echo json_encode(EntrepriseModel::where('id_entreprise', $id)->update($entre));
    }

    public function delete(Request $request){
        $id = $request->input('id_entreprise');
        echo json_encode(EntrepriseModel::where('id_entreprise', $id)->delete());
    }
}
