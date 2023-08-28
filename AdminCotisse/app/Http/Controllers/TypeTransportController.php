<?php

namespace App\Http\Controllers;

use App\Models\TypeTransport;
use App\Models\Membre;
use Illuminate\Http\Request;

class TypeTransportController extends Controller
{
    //
    public function index(){
        $type = new TypeTransport();
        $list = $type->getList();

        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();

        return view('content.typeTransport',[
            'list' => $list,
            'typesmembres' => $typemembres
        ]);
    }
    public function ajouter(Request $request){
        $nom = $request->input('nom');
        $type = new TypeTransport();
        $type->insert($nom);
        return redirect()->route('typetransport');
    }
    public function supprimer($id){
        $type = new TypeTransport();
        $type->supprimer($id);
        return redirect()->route('typetransport');
    }
}
