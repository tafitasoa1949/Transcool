<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Membre;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function List(){
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();
        $reservation = new Reservation();
        $list = $reservation->getList();
        $list_alefa = [];
        foreach($list as $indice){
            $nbrPlace = $reservation->getNombrePlace($indice->id,$indice->daty);
            $data = array(
                'id' => $indice->id,
                'client' => $indice->client,
                'depart' => $indice->depart,
                'arrive' => $indice->arrive,
                'nbr' => $nbrPlace->nbr,
                'methode' => $indice->methode,
                'daty' => $indice->daty
            );
            array_push($list_alefa,$data);
        }
        return view('content.reservation.list',[
            'typesmembres' => $typemembres,
            'list' => $list_alefa
        ]);
    }
    public function VoirReservationClient($id){
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();
        $reservation = new Reservation();
        $list = $reservation->getListByClient($id);
        $list_alefa = [];
        foreach($list as $indice){
            $nbrPlace = $reservation->getNombrePlace($indice->id,$indice->daty);
            $data = array(
                'id' => $indice->id,
                'client' => $indice->client,
                'depart' => $indice->depart,
                'arrive' => $indice->arrive,
                'nbr' => $nbrPlace->nbr,
                'methode' => $indice->methode,
                'daty' => $indice->daty
            );
            array_push($list_alefa,$data);
        }
        return view('content.reservation.list',[
            'typesmembres' => $typemembres,
            'list' => $list_alefa
        ]);
    }
    public function VoirDetailReservation($idReservation){
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();
        $reservation = new Reservation();
        $listdetail = $reservation->getDetail($idReservation);
        return view('content.reservation.detail',[
            'typesmembres' => $typemembres,
            'listdetail' => $listdetail
        ]);
    }
    public function rechercheFacture(Request $request){
        $mots = $request->input('mots');
        $mots = strtoupper($mots);
        $client = new Client();
        $result = $client->getSeach($mots);
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();

        return view('content.clients.list',[
            'list' => $result ,
            'typesmembres' => $typemembres
        ]);
    }
}
