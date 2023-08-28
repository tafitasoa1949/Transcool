<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }
    public function check(Request $request){
        $email = $request->input('email');
        $mdp = $request->input('mdp');
        $client = new Login();
        $user = $client->VerifierLoginClient($email,$mdp);
        if(count($user) > 0){
            $reservation = new Reservation();
            $typetransport = $reservation->getTypeTransport();
            $idclient = $client->getIdClientByEmail($email);
            $request->session()->put('idclient', $idclient);
            return view('home',[
                'type' => $typetransport
            ]);
        }else{
            $message = "identifiant incorrect";
            return view('login',[
                'message' => $message
            ]);
        }
    }
    public function voirInscription(){
        return view('inscription');
    }
    public function creerNewClient(Request$request){
        $client = new Login();
        $idclient = $client->getId();
        $data = array(
            'id' => $idclient,
            'nom' => $request->input('nom'),
            'prenoms' => $request->input('prenoms'),
            'email' => $request->input('email'),
            'mdp' => $request->input('mdp'),
            'cin' => $request->input('cin'),
            'contact' => $request->input('contact'),
        );
        $client->insererClient($data);
        return redirect()->route('login');
    }
    public function deconnexion(Request $request){
        //$request->session()->forget('key');
        $request->session()->flush();
        return redirect()->route('login');
    }
}
