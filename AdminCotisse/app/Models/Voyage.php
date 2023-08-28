<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voyage extends Model
{
    use HasFactory;
    public function insert($data){
        DB::table('voyage')->insert([
            'idbus' => $data['idbus'],
            'idchauffeur' => $data['idchauffeur'],
            'depart' => $data['depart'],
            'arrive' => $data['arrive'],
            'datedepart' => $data['datedepart'],
            'datearrive' => $data['datearrive'],
            'prix' => $data['prix']
        ]);
    }
    public function getList(){
        $result = DB::select("select v.id,b.nom as vehicule,m.nom as chauffeur,t.nom as type,depart.nom as depart,arrive.nom as arrive,v.datedepart,v.datearrive,v.prix
        FROM voyage AS v
        JOIN ville AS depart ON depart.id = v.depart
        JOIN ville AS arrive ON arrive.id = v.arrive
        JOIN bus AS b ON b.id = v.idbus
        JOIN typetransport AS t ON b.iddtypetransport = t.id
        JOIN membre AS m ON m.id = v.idchauffeur");
        return $result;
    }
    public function getListVille(){
        $result = DB::select("select * from ville");
        return $result;
    }
    public function supprimer($id){
        DB::table('voyage')
        ->where('id',$id)
        ->delete();
    }

    // Liste des voyages en une journee
    public function getListeVoyageJour($jour ,$mois, $annee){
        $date = $annee."/".$mois."/".$jour;
        $result = DB::select("SELECT * FROM voyage WHERE date_trunc('day', datedepart)=?", [$date]);

        return $result;
    }

    // Liste des voyages en un mois
    public function getListeVoyageMois($mois, $annee){
        $result = DB::select("SELECT * FROM voyage
        WHERE EXTRACT(MONTH From datedepart)=?
        AND EXTRACT(YEAR From datedepart)=?", [$mois, $annee]);

        return $result;
    }

    // Nombre de voyage par jour en un mois
    public function nombreVoyagesMois($mois, $annee, $graphe){
        $nbVoyages = [];
        $nbJours = $graphe->getJoursMois($mois,$annee);
        foreach($nbJours as $jour){
            array_push($nbVoyages, count($this->getListeVoyageJour($jour,$mois, $annee)));
        }
        return $nbVoyages;
    }

// -------------------------------- REVENU ---------------------------------

    // Total de revenu d'un voyage
    public function getTotalRevenue($idvoyage){
        $result = DB::select("SELECT v.id as idvoyage,sum(v.prix) as revenue
        FROM detailreservation as dr
        JOIN reservation as r ON r.id = dr.idreservation
        JOIN voyage as v ON v.id = r.idvoyage
        WHERE idvoyage=?
        GROUP BY v.id", [$idvoyage]);

        if(count($result) > 0){
            return $result[0]->revenue;
        }else{
            return 0;
        }
    }

    // Total de revenue pendant un mois
    public function getTotalRevenueMensuel($mois, $annee){
        $listeVoyages = $this->getListeVoyageMois($mois, $annee);
        $revenu = 0;
        foreach($listeVoyages as $voyage){
            $revenu = $revenu + $this->getTotalRevenue($voyage->id);
        }
        return $revenu;
    }

    // Total de revenue pendant une journee
    public function getTotalRevenuParJours($jour, $mois, $annee){
        $listeVoyages = $this->getListeVoyageJour($jour, $mois, $annee);
        $revenu = 0;
        foreach($listeVoyages as $voyage){
            $revenu = $revenu + $this->getTotalRevenue($voyage->id);
        }
        return $revenu;
    }

    //Total de revenu pendant tous les jours d'un mois donnee
    public function getRevenuParJoursEnUnMois($mois, $annee, $graphe){
        $gainsParJours = [];
        $jours = $graphe->getJoursMois($mois,$annee);
        foreach ($jours as $jour) {
            array_push($gainsParJours, $this->getTotalRevenuParJours($jour,$mois,$annee));
        }
        return $gainsParJours;
    }
}
