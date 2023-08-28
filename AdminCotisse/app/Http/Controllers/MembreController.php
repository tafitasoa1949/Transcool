<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MembreController extends Controller
{
    //
    public function index($idtypemembre){
        $membre = new Membre();

        $typemembre = $membre->getTypeMembre($idtypemembre);
        $typemembres = $membre->getTousTypeMembres();
        $listemembre = $membre->getMembresActifs($idtypemembre);
        $listeancienmembre = $membre->getAnciensMembres($idtypemembre);

        return view('historique.membre', [
            'typemembre' => $typemembre,
            'typesmembres' => $typemembres,
            'listemembre' => $listemembre,
            'listeancienmembre' => $listeancienmembre
        ]);
    }

    public function ajouter(Request $request){
        $membre = new Membre();

        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $idtypemembre = $request->input('idtypemembre');
        $salaire = $request->input('salaire');
        $datedebut = $request->input('datedebut');

        $membre->ajouterNouveauMembre($nom,$prenom,$idtypemembre,$salaire,$datedebut);
        return redirect()->route('historiqueMembre',[$idtypemembre]);
    }

    public function champModification($idmembre){
        $membre = new Membre();

        $mbr = $membre->getMembre($idmembre);
        $mbr->datedebut = date("m/d/Y", strtotime($mbr->datedebut));
        $idtypemembre = $mbr->idtypemembre;

        $typemembre = $membre->getTypeMembre($idtypemembre);
        $typemembres = $membre->getTousTypeMembres();
        $listemembre = $membre->getMembresActifs($idtypemembre);
        $listeancienmembre = $membre->getAnciensMembres($idtypemembre);

        return view('historique.membre', [
            'typemembre' => $typemembre,
            'typesmembres' => $typemembres,
            'listemembre' => $listemembre,
            'listeancienmembre' => $listeancienmembre,
            'membre' => $mbr,
            'modification' => "true"
        ]);
    }

    public function modifier(Request $request){
        $membre = new Membre();

        $idmembre = $request->input('idmembre');
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $idtypemembre = $request->input('idtypemembre');
        $salaire = $request->input('salaire');

        $olddatedebut = $request->input('olddatedebut');
        $datedebut = $request->input('datedebut');

        if($datedebut == null || $datedebut == ''){
            $datedebut = $olddatedebut;
        }

        $membre->modifierMembre($idmembre,$nom,$prenom,$idtypemembre,$salaire,$datedebut);
        return redirect()->route('historiqueMembre',[$idtypemembre]);
    }

    public function champDemission($idmembre){
        $membre = new Membre();

        $mbr = $membre->getMembre($idmembre);
        $idtypemembre = $mbr->idtypemembre;

        $typemembre = $membre->getTypeMembre($idtypemembre);
        $typemembres = $membre->getTousTypeMembres();
        $listemembre = $membre->getMembresActifs($idtypemembre);
        $listeancienmembre = $membre->getAnciensMembres($idtypemembre);

        return view('historique.membre', [
            'typemembre' => $typemembre,
            'typesmembres' => $typemembres,
            'listemembre' => $listemembre,
            'listeancienmembre' => $listeancienmembre,
            'idMembreDemission' => $idmembre,
            'demission' => "true"
        ]);
    }

    public function confirmerDemission(Request $request){
        $membre = new Membre();

        $idmembre = $request->input('idmembre');
        $idtypemembre = $request->input('idtypemembre');
        $datefin = $request->input('datefin');

        if($datefin == null || $datefin == ""){
            $datefin = Carbon::now()->format('Y-m-d');
        }

        $membre->demissionerMembre($idmembre, $datefin);
        return redirect()->route('historiqueMembre',[$idtypemembre]);
    }

    public function annulerDemission($idmembre){
        $membre = new Membre();

        $mbr = $membre->getMembre($idmembre);
        $idtypemembre = $mbr->idtypemembre;

        $typemembre = $membre->getTypeMembre($idtypemembre);
        $typemembres = $membre->getTousTypeMembres();
        $listemembre = $membre->getMembresActifs($idtypemembre);
        $listeancienmembre = $membre->getAnciensMembres($idtypemembre);

        return view('historique.membre', [
            'typemembre' => $typemembre,
            'typesmembres' => $typemembres,
            'listemembre' => $listemembre,
            'listeancienmembre' => $listeancienmembre,
            'idMembreDemission' => $idmembre,
            'demission' => "false"
        ]);
    }

    public function champReembauche($idmembre){
        $membre = new Membre();

        $mbr = $membre->getMembre($idmembre);
        $idtypemembre = $mbr->idtypemembre;

        $typemembre = $membre->getTypeMembre($idtypemembre);
        $typemembres = $membre->getTousTypeMembres();
        $listemembre = $membre->getMembresActifs($idtypemembre);
        $listeancienmembre = $membre->getAnciensMembres($idtypemembre);

        return view('historique.membre', [
            'typemembre' => $typemembre,
            'typesmembres' => $typemembres,
            'listemembre' => $listemembre,
            'listeancienmembre' => $listeancienmembre,
            'idMembreReembauche' => $idmembre,
            'reembauche' => "true"
        ]);
    }

    public function confirmerReembauche(Request $request){
        $membre = new Membre();

        $idmembre = $request->input('idmembre');
        $idtypemembre = $request->input('idtypemembre');
        $datedebut = $request->input('datedebut');
        $salaire = $request->input('nouveausalaire');

        if($datedebut == null || $datedebut == ""){
            $datedebut = Carbon::now()->format('Y-m-d');
        }

        $membre->reembaucherMembre($idmembre, $salaire, $datedebut);
        return redirect()->route('historiqueMembre',[$idtypemembre]);
    }
    ////////salaire
    public function getSalaire(){
        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();
        $listmembre = $membre->getSalaire();
        return view('facturation.membres.list',[
            'typesmembres' => $typemembres,
            'listmembre' => $listmembre
        ]);
    }
    public function getSalaireParType(Request $request){
        $idtype = $request->input('idtype');
        if(isset($idtype)){
            $membre = new Membre();
            $typemembres = $membre->getTousTypeMembres();
            $listmembre = $membre->getSalaireParType($idtype);
            return view('facturation.membres.list',[
                'typesmembres' => $typemembres,
                'listmembre' => $listmembre
            ]);
        }else{
            return redirect()->route('salaire');
        }
    }
}
