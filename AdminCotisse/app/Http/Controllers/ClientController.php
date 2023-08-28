<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membre;
use App\Models\Client;
use App\Models\Reservation;

class ClientController extends Controller
{
    //
    public function listPlainteClients(){
        $clients = new Client();
        $listplaintes = $clients->getListPlaintes();
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();

        return view('plaintes.list',[
            'listplaintes' => $listplaintes ,
            'typesmembres' => $typemembres
        ]);
    }
    //////facturation
    public function getListClientFacture(){
        $clients = new Client();
        $listfacture = $clients->getListFacture();
        $list_alefa = [];
        foreach($listfacture as $indice){
            if (strlen($indice->id) < 3) {
                $facture = str_pad($indice->id, 3, '0', STR_PAD_LEFT);
            }
            $facture = "FAC".$facture;
            $data = array(
                'id' => $indice->id,
                'client' => $indice->client,
                'numero' => $facture,
                'daty' => $indice->daty
            );
            array_push($list_alefa,$data);
        }
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();
        return view('facturation.clients.list',[
            'listfacture' => $list_alefa ,
            'typesmembres' => $typemembres
        ]);
    }
    public function getDetail($id){
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();
        $clients = new Client();
        $detail = $clients->getDetailFacture($id);
        $listePlace = $clients->getListePlaceReservation($id,$detail->daty);
        return view('facturation.clients.detail',[
            'typesmembres' => $typemembres,
            'detail' => $detail,
            'listeplace' => $listePlace
        ]);
    }
}
