<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Voyage;
use App\Models\Membre;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    //
    public function index(){
        $voyage = new Voyage();
        $list = $voyage->getList();
        $listVille = $voyage->getListVille();
        $bus = new Bus();
        $listBus = $bus->getList();

        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();

        $listChauffeur = $membre->getMembresActifs($membre->getTypeMembreId("chauffeur"));

        return view('content.voyage',[
            'list'=>$list,
            'listBus'=>$listBus,
            'listVille'=>$listVille,
            'listChauffeur'=>$listChauffeur,
            'typesmembres' => $typemembres
        ]);
    }
    public function ajouter(Request $request){
        $data = array(
            'idbus' => $request->input('idbus'),
            'idchauffeur' => $request->input('idchauffeur'),
            'depart' => $request->input('idvilledepart'),
            'arrive' => $request->input('idvillearrive'),
            'datedepart' => $request->input('datedepart'),
            'datearrive' => $request->input('datearrive'),
            'prix' => $request->input('prix'),
        );
        //print_r($data);
        $voyage = new Voyage();
        $voyage->insert($data);
        return redirect()->route('voyage');
    }
    public function supprimer($id){
        $voyage = new Voyage();
        $voyage->supprimer($id);
        return redirect()->route('voyage');
    }
}
