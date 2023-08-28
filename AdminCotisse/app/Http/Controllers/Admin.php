<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Membre;
use Illuminate\Http\Request;

class Admin extends Controller
{
    //
    public function index(){
        $clients = new Client();
        $list = $clients->getList();

        $membre = new Membre();
        $typemembres = $membre->getTousTypeMembres();

        return view('content.clients.list',[
            'list' => $list ,
            'typesmembres' => $typemembres
        ]);
    }
}
