<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\CompteClientModel;
use Illuminate\Http\Request;

class CompteClientController extends Controller
{
    public function index(){
        return view('pages.compteClient');
    }

    public function insert(Request $request){
        $compteCli = array(
        'num_compte' => $request->input('num_compte'),
        'total' => $request->input('total'),
        'id_client' => $request->input('id_client'),
        );
        echo json_encode(CompteClientModel::create($compteCli));        
    }

    public function list(Request $request){
        $compteCli = CompteClientModel::all();
        foreach($compteCli as $cptl){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$cptl->num_compte."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$cptl->num_compte."')\" >Supprimer</a>";
            $output['data'][] = array(
                'total' => $cptl->total,
                'id_client' => ClientModel::find($cptl->id_client)->nom_client,
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getCompteClient(Request $request){
        $id = $request->input('num_compte');
        $cptl = CompteClientModel::find($id);
        echo json_encode($cptl);
    }

    public function update(Request $request){
        $id = $request->input('num_compte');
        $cptl = array(
            'total' => $request->input('total'),
            'id_client' => $request->input('id_client'),
            );
        echo json_encode(CompteClientModel::where('num_compte', $id)->update($cptl));
    }

    public function delete(Request $request){
        $id = $request->input('num_compte');
        echo json_encode(CompteClientModel::where('num_compte', $id)->delete());
    }

    public function idClient(){
        $client = ClientModel::all();
        $idClient = "
        <td>Client :</td>
        <td><select class=\"form-control\" name=\"id_client\" id=\"idClient\">";
        foreach($client as $cli){
            $idClient .= "<option value=\"$cli->id_client\">$cli->nom_client</option>";
        }
        $idClient.= "</select><td>";
        echo json_encode($idClient);
    }
}
