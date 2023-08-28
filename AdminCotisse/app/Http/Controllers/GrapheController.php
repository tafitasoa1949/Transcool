<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Graphe;
use App\Models\Voyage;
use Illuminate\Http\Request;

class GrapheController extends Controller
{
    //
    public function index($idmembre){
        $membre = new Membre();
        $graphe = new Graphe();

        $mbr = $membre->getMembre($idmembre);
        $mbr->datedebut = date("m/d/Y", strtotime($mbr->datedebut));
        $idtypemembre = $mbr->idtypemembre;

        $typemembre = $membre->getTypeMembre($idtypemembre);
        $typemembres = $membre->getTousTypeMembres();

        $mois = $graphe->getTousMoisEnChiffre();
        $annees = $graphe->getAnnees();

        // $nbVoy = $membre->nombreVoyageMois($idmembre,7,2023,$graphe);

        $estUngrapheVoyage = false;
        if(str_contains(strtolower($typemembre->type),strtolower("chauffeur"))){
            $estUngrapheVoyage = true;
        }

        return view('historique.graphe', [
            'typemembre' => $typemembre,
            'typesmembres' => $typemembres,
            'membre' => $mbr,
            'moisChoix' => $mois,
            'anneeChoix' => $annees,
            'grapheVoyage' => $estUngrapheVoyage
        ]);
    }

    public function grapheVoyage($idmembre,$mois,$annee){
        $membre = new Membre();
        $graphe = new Graphe();
        $voyage = new Voyage();

        $jours = $graphe->getJoursMois($mois,$annee);
        $nbVoyages = $membre->nombreVoyageMois($idmembre,$mois,$annee,$graphe);
        $gainsVoyages = $membre->listeGainsMois($idmembre,$mois,$annee,$voyage,$graphe);


        $donneesGraphe = [
            'jours' => $jours,
            'nbVoyages' => $nbVoyages,
            'gainsVoyages' => $gainsVoyages
        ];
        return response()->json($donneesGraphe);
    }
}
