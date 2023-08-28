<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bus extends Model
{
    use HasFactory;
    public function insert($data){
        DB::table('bus')->insert([
            'nom' => $data['nom'],
            'iddtypetransport' => $data['idtypetransport']
        ]);
    }
    public function getList(){
        $result = DB::select("select bus.id,bus.nom,t.nom as vehicule from bus join typetransport as t on t.id=bus.iddtypetransport");
        return $result;
    }
    public function supprimer($id){
        DB::table('bus')
        ->where('id',$id)
        ->delete();
    }
    public function getListeParType($idtypetransport){
        $result = DB::select("SELECT * FROM bus WHERE iddtypetransport=?", [$idtypetransport]);
        return $result;
    }
    public function getBus($idbus){
        $result = DB::select("SELECT b.id as idbus,b.nom,b.iddtypetransport,t.id as idtype,t.nom as type
        FROM bus AS b
        JOIN typetransport AS t
        ON t.id=b.iddtypetransport
        WHERE b.id=?", [$idbus]);

        return $result[0];
    }
    public function getTotalVoyage($idbus){
        $result = DB::select("SELECT COUNT(idbus) AS total FROM voyage WHERE idbus=?", [$idbus]);

        return $result[0]->total;
    }
    public function nombreVoyageJour($idbus,$jour,$mois,$annee){
        $date = strval($annee)."-".strval($mois)."-".strval($jour);
        $result = DB::select("SELECT count(id) as nombre
            FROM voyage as v
            WHERE date_trunc('day',datedepart)=?
            AND idbus=?", [$date, $idbus]);

        return $result[0]->nombre;
    }
    public function nombreVoyageParJourMois($idbus,$mois,$annee,$graphe){
        $nbvoyages = [];

        $jours = $graphe->getJoursMois($mois, $annee);
        foreach($jours as $jour){
            array_push($nbvoyages, $this->nombreVoyageJour($idbus,$jour,$mois,$annee));
        }
        return $nbvoyages;
    }
    public function getTotalVoyageParMois($idbus,$mois,$annee,$graphe){
        $total = 0;
        $nbParJours = $this->nombreVoyageParJourMois($idbus,$mois,$annee,$graphe);
        foreach($nbParJours as $nombre){
            $total = $total + $nombre;
        }
        return $total;
    }
}
