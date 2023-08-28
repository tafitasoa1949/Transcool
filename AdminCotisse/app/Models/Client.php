<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    public function getList(){
        $result = DB::select("SELECT * FROM client");
        return $result;
    }

    public function getListPlaintes(){
        $result = DB::select("SELECT c.nom as nom,c.prenoms as prenoms,com.coms as coms,com.daty as daty FROM commentaire as com
        join client as c on c.id=com.idclient");
        return $result;
    }
    public function getListFacture(){
        $result = DB::select("SELECT c.nom as client,re.id as id,re.daty as daty FROM reservation as re
        join client as c on c.id=re.idclient order by daty desc");
        return $result;
    }
    public function getDetailFacture($idreservation){
        $result = DB::selectOne("SELECT c.nom as nom,c.prenoms as prenoms,c.contact as contact,re.argent as prix ,
        re.daty as daty,depart.nom as depart,arrive.nom as arrive
        FROM reservation as re
        join voyage as v on v.id=re.idvoyage
        join ville as depart on depart.id = v.depart
        join ville as arrive on arrive.id=v.arrive
        join client as c on c.id=re.idclient where re.id=".$idreservation);
        return $result;
    }
    public function getListePlaceReservation($idReservation,$daty){
        $result = DB::select("SELECT idplace
        from detailreservation as det
        JOIN reservation as re on re.id=det.idreservation where re.id=".$idReservation." and re.daty='".$daty."'");
        $listeplace = [];
        foreach ($result as $row) {
            $listeplace[] = $row->idplace;
        }
        return $listeplace;
    }
    public function getSeach($mots){
        $result = DB::select("SELECT * from client where id like '%".$mots."%' or nom like '%".$mots."%'");
        return $result;
    }
}
