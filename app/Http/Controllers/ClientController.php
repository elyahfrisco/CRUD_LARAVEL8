<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\EntrepriseModel;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(){
        return view('pages.client');
    }

    public function insert(Request $request){
        $client = array(
        'nom_client' => $request->input('nom_client'),
        'cin' => $request->input('cin_client'),
        'tel' => $request->input('tel_fond'),
        'email' => $request->input('email_client'),
        'adresse' => $request->input('adresse_client'),
        'id_entreprise' => $request->input('id_entreprise')
        );
        echo json_encode(ClientModel::create($client));        
    }

    public function list(Request $request){
        $client = ClientModel::all();
        foreach($client as $clt){
            $action = "<a href='javascript:void(0)' class='btn btn-primary' onclick=\"modifier('".$clt->id_client."')\" >Modifier</a><a href='javascript:void(0)' class='btn btn-danger' onclick=\"supprimer('".$clt->id_client."')\" >Supprimer</a>";
            $output['data'][] = array(
                'nom_client' => $clt->nom_client,
                'cin' => $clt->cin,
                'tel' => $clt->tel,
                'email' => $clt->email,
                'adresse' => $clt->adresse,
                'id_entreprise' => ($clt->id_entreprise == null) ? ($clt->id_entreprise) : (EntrepriseModel::find($clt->id_entreprise)->nom_entreprise),
                'action' => $action
            );
        }
        echo json_encode($output);
    }

    public function getClient(Request $request){
        $id = $request->input('id_client');
        $clt = ClientModel::find($id);
        echo json_encode($clt);
    }

    public function update(Request $request){
        $id = $request->input('id_client');
        $client = array(
            'nom_client' => $request->input('nom_client'),
            'cin' => $request->input('cin_client'),
            'tel' => $request->input('tel_client'),
            'email' => $request->input('email_client'),
            'adresse' => $request->input('adresse_client'),
            'id_entreprise' => $request->input('id_entreprise')
            );
        echo json_encode(ClientModel::where('id_client', $id)->update($client));
    }

    public function delete(Request $request){
        $id = $request->input('id_client');
        echo json_encode(ClientModel::where('id_client', $id)->delete());
    }

    public function idEntreprise(){
        $entreprise = EntrepriseModel::all();
        $idEntreprise = "
        <td>Entreprise :</td>
        <td><select class=\"form-control\" name=\"id_entreprise\" id=\"idEntreprise\">
        <option value=\"\"></option>";
        foreach($entreprise as $entre){
            $idEntreprise .= "<option value=\"$entre->id_entreprise\">$entre->nom_entreprise</option>";
        }
        $idEntreprise.= "</select><td>";
        echo json_encode($idEntreprise);
    }
}
