<?php

namespace App\Http\Controllers;

use App\Models\FondCaisseModel;
use Illuminate\Http\Request;

class FondCaisseController extends Controller
{

    public function index(){
        return view('pages.fondCaisse');
    }

    public function insert(Request $request){
        $fond = array(
        'total_fond' => $request->input('total_fond'),
        'date' => $request->input('date_fond'),
        );
        echo json_encode(FondCaisseModel::create($fond));        
    }

    public function list(Request $request){
        $fondCaisse = FondCaisseModel::all();
        foreach($fondCaisse as $fond){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$fond->id_fond."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$fond->id_fond."')\" >Supprimer</a>";
            $output['data'][] = array(
                'total_fond' => $fond->total_fond,
                'date' => $fond->date,
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getFond(Request $request){
        $id = $request->input('id_fond');
        $fond = FondCaisseModel::find($id);
        echo json_encode($fond);
    }

    public function update(Request $request){
        $id = $request->input('id_fond');
        $fond = array(
            'total_fond' => $request->input('total_fond'),
            'date' => $request->input('date_fond'),
            );
        echo json_encode(FondCaisseModel::where('id_fond', $id)->update($fond));
    }

    public function delete(Request $request){
        $id = $request->input('id_fond');
        echo json_encode(FondCaisseModel::where('id_fond', $id)->delete());
    }
}
