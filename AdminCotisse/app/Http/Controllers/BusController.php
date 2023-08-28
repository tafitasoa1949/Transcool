<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\TypeTransport;
use App\Models\Membre;
use Illuminate\Http\Request;

class BusController extends Controller
{
    //
    public function index(){
        $bus = new Bus();
        $list = $bus->getList();
        $type = new TypeTransport();
        $listType = $type->getList();

        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();

        return view('content.bus',[
            'list'=>$list,
            'listType'=>$listType,
            'typesmembres' => $typemembres
        ]);
    }
    public function ajouter(Request $request){
        $data = array(
            'nom' => $request->input('nom'),
            'idtypetransport' => $request->input('idtypetransport')
        );
        $bus = new Bus();
        $bus->insert($data);
        return redirect()->route('bus');
    }
    public function supprimer($id){
        $bus = new Bus();
        $bus->supprimer($id);
        return redirect()->route('bus');
    }
}
