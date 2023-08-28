<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graphe extends Model
{
    use HasFactory;

    public function getTousMoisEnChiffre(){
        $moisCode = [1,2,3,4,5,6,7,8,9,10,11,12];
        $moisNom = ["Janvier", "Février", "Mars", "Avril",
         "Mai", "Juin", "Juillet", "Août",
          "Septembre", "Octobre", "Novembre", "Décembre"];

        $mois = [];

        for($i = 0 ; $i<count($moisCode) ; $i++){
            $mois[$i]['code'] = $moisCode[$i];
            $mois[$i]['nom'] = $moisNom[$i];
        }
        return $mois;
    }

    public function getMoisEnLettre($code){
        $mois = $this->getTousMoisEnChiffre();
        foreach($mois as $m){
            if($m['code'] == $code){
                return $m['nom'];
            }
        }
    }

    public function getJoursMois($moisChiffre, $annee){
        $date = Carbon::create($annee, $moisChiffre, 1);
        $nombreJour = $date->daysInMonth;

        $result = [];
        for($i = 1 ; $i<=$nombreJour ; $i++){
            array_push($result, $i);
        }
        return $result;
    }

    public function getAnnees(){
        $annee = [];
        for($i = 2020; $i<=2030 ; $i++){
            array_push($annee, $i);
        }
        return $annee;
    }
}
