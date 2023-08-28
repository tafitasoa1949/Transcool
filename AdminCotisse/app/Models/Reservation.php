<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;
    public function getNombrePlace($idReservation,$daty){
        $result = DB::selectOne("SELECT count(idplace) as nbr
        from detailreservation as det
        JOIN reservation as re on re.id=det.idreservation where re.id=".$idReservation." and re.daty='".$daty."'");
        return $result;
    }
    public function getList(){
        $result = DB::select("SELECT re.id as id,c.nom as client,depart.nom as depart,arrive.nom as arrive,re.methode as methode,re.daty as daty
        from reservation as re
        JOIN voyage as v on v.id=re.idvoyage
        JOIN ville as depart on depart.id=v.depart
        JOIN ville as arrive on arrive.id=v.arrive
        JOIN client as c on c.id=re.idclient order by daty desc");
        return $result;
    }
    public function getListByClient($idclient){
        $result = DB::select("SELECT re.id as id,c.nom as client,depart.nom as depart,arrive.nom as arrive,re.methode as methode,re.daty as daty
        from reservation as re
        JOIN voyage as v on v.id=re.idvoyage
        JOIN ville as depart on depart.id=v.depart
        JOIN ville as arrive on arrive.id=v.arrive
        JOIN client as c on c.id=re.idclient  where c.id in ('".$idclient."') order by daty desc");
        return $result;
    }
    public function getDetail($idReservation){
        $result = DB::select("select c.nom as client,det.idplace as place,re.daty
        from reservation as re
        join detailreservation as det on det.idreservation=re.id
        join voyage as v on v.id=re.idvoyage
        join client as c on c.id=re.idclient where re.id =".$idReservation);
        return $result;
    }
}
