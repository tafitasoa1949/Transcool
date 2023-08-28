<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Graphe;
use App\Models\Voyage;
use App\Models\Bus;
use App\Models\TypeTransport;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    //

    public function index(){
        $membre = new Membre();
        $graphe = new Graphe();

        $typemembres = $membre->getTousTypeMembres();

        $mois = $graphe->getTousMoisEnChiffre();
        $annees = $graphe->getAnnees();

        return view('statistique.revenu', [
            'typesmembres' => $typemembres,
            'moisChoix' => $mois,
            'anneeChoix' => $annees
        ]);
    }

    public function revenuMensuel($mois, $annee){
        $voyage = new Voyage();
        $graphe = new Graphe();

        $revmens = $voyage->getTotalRevenueMensuel($mois,$annee);
        $jours = $graphe->getJoursMois($mois,$annee);
        $moisLettre = $graphe->getMoisEnLettre($mois);

        $nbvoyagesParJours = $voyage->nombreVoyagesMois($mois, $annee, $graphe);
        $gainsParJours = $voyage->getRevenuParJoursEnUnMois($mois, $annee, $graphe);

        $donneesGraphe = [
            'revmens' => $revmens,
            'jours' => $jours,
            'moisLettre' => $moisLettre,
            'nbvoyagesParJours' => $nbvoyagesParJours,
            'gainsParJours' => $gainsParJours
        ];
        return response()->json($donneesGraphe);
    }

    public function indexVehicule(){
        $membre = new Membre();
        $bus = new Bus();
        $type = new TypeTransport();

        $typemembres = $membre->getTousTypeMembres();
        $listeType = $type->getList();

        $listeBusParType = collect([]);
        foreach($listeType as $type){
            $listeBus = $bus->getListeParType($type->id);
            $listeBusParType->put($type->nom, $listeBus);
        }

        //dump($listeBusParType->all());

        return view('statistique.vehicule', [
            'typesmembres' => $typemembres,
            'listeType' => $listeType,
            'listeBusParType' => $listeBusParType,
            'choixVehicule' => true
        ]);
    }

    public function rapportVehicule($idvehicule){
        $membre = new Membre();
        $bus = new Bus();
        $graphe = new Graphe();

        $typemembres = $membre->getTousTypeMembres();
        $moisChoix = $graphe->getTousMoisEnChiffre();
        $anneeChoix = $graphe->getAnnees();

        $vehicule = $bus->getBus($idvehicule);
        $totalVoyage = $bus->getTotalVoyage($idvehicule);

        return view('statistique.vehicule', [
            'typesmembres' => $typemembres,
            'moisChoix' => $moisChoix,
            'anneeChoix' => $anneeChoix,
            'vehicule' => $vehicule,
            'totalVoyage' => $totalVoyage,
            'grapheVehicule' => true
        ]);
    }

    public function graphVehicule($idvehicule,$mois,$annee){
        $bus = new Bus();
        $graphe = new Graphe();

        $jours = $graphe->getJoursMois($mois,$annee);
        $moisLettre = $graphe->getMoisEnLettre($mois);

        $totalVoyages = $bus->getTotalVoyageParMois($idvehicule,$mois,$annee,$graphe);
        $listesNbVoyages = $bus->nombreVoyageParJourMois($idvehicule,$mois,$annee,$graphe);

        $donneesGraphe = [
            'jours' => $jours,
            'moisLettre' => $moisLettre,
            'totalVoyages' => $totalVoyages,
            'listesNbVoyages' => $listesNbVoyages
        ];

        return response()->json($donneesGraphe);
    }
}
