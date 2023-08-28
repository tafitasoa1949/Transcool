<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;
    public function getTypeTransport(){
        $result = DB::select("select * from typetransport");
        return $result;
    }
    public function getVille(){
        $result = DB::select("select * from ville");
        return $result;
    }
    public function getVoyageDispo($idtype,$depart,$arrive,$dateActuel){
        $result = DB::select("SELECT v.id as idvoyage,v.datedepart,b.nom as vehicule,v.prix
        FROM voyage AS v
        JOIN ville AS depart ON depart.id = v.depart
        JOIN ville AS arrive ON arrive.id = v.arrive
        JOIN bus AS b ON b.id = v.idbus
        where b.iddtypetransport = ".$idtype." and depart.id = ".$depart." and arrive.id = ".$arrive."
        and v.datedepart > '".$dateActuel."'");
        return $result;
    }
    public function getNomVille($id){
        $result = DB::table('ville')
            ->where('id', $id)
            ->pluck('nom')
            ->first();
        return $result;
    }
    public function getIdBusVoyage($idvoyage){
        $result = DB::table('voyage')
            ->where('id', $idvoyage)
            ->pluck('idbus')
            ->first();
        return $result;
    }
    public function getPlace(){
        $result = DB::select("select * from place");
        return $result;
    }
    public function getPlaceIndispo($idvoyage){
        $result = DB::select("SELECT * FROM reservation
        join detailreservation as detail on detail.idreservation=reservation.id where idvoyage=".$idvoyage);
        $placeIndispo = [];
        foreach ($result as $row) {
            $placeIndispo[] = $row->idplace;
        }
        return $placeIndispo;
    }
    public function getPrixVoyage($idvoyage){
        $result = DB::table('voyage')
            ->where('id', $idvoyage)
            ->pluck('prix')
            ->first();
        return $result;
    }
    public function EcritComs($data){
        DB::table('commentaire')->insert([
            'idclient' => $data['idclient'],
            'coms' => $data['coms'],
            'daty' => $data['daty']
        ]);
    }

    public function getClientById($idclient){
        $result = DB::table('client')->where('id', $idclient)->first();
        return $result;
    }

    public function chekSms($reference){
        $result = DB::table('sms')->where('reference', $reference)->first();
        return $result;
    }
    public function insererReservation($data){
        DB::table('reservation')->insert([
            'idclient' => $data['idclient'],
            'idvoyage' => $data['idvoyage'],
            'methode' => "En ligne",
            'argent' => $data['argent'],
            'daty' => $data['daty']
        ]);
    }
    public function getIdReservation($idclient,$idvoyage,$argent){
        $result = DB::table('reservation')
            ->where('idclient', $idclient)
            ->where('idvoyage', $idvoyage)
            ->where('argent', $argent)
            ->pluck('id')
            ->first();
        return $result;
    }
    public function insererDetailReservation($data){
        DB::table('detailreservation')->insert([
            'idreservation' => $data['idreservation'],
            'idplace' => $data['idplace']
        ]);
    }
    public function getReservationById($idReservation){
        $result = DB::table('reservation')->where('id', $idReservation)->first();
        return $result;
    }
    public function DateDepartVilleDepartArriveParIdVoyage($idvoyage){
        $result = DB::selectOne("select datedepart, depart.nom as depart, arrive.nom as arrive
        from voyage as v
        JOIN ville as depart on depart.id = v.depart
        JOIN ville as arrive on arrive.id = v.arrive
        where v.id = ".$idvoyage);
        return $result;
    }

}
