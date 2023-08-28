<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;
    public function getId(){
        $dao = DB::select("select getseqclient() as sequence");
        $sequence = $dao[0]->sequence;
        if (strlen($sequence) < 3) {
            $idclient = str_pad($sequence, 3, '0', STR_PAD_LEFT);
        }
        return "CLT".$idclient;
    }
    public function getIdClientByEmail($email){
        $result = DB::table('client')
            ->where('email', $email)
            ->pluck('id')
            ->first();
        return $result;
    }
    public function insererClient($data){
        DB::table('client')->insert([
            'id' => $data['id'],
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'email' => $data['email'],
            'mdp' => sha1($data['mdp']),
            'cin' => $data['cin'],
            'contact' => $data['contact']
        ]);
    }
    public function VerifierLoginClient($email, $mdp){
        $result = DB::select('SELECT * FROM client WHERE email = ? AND mdp = ?', [$email, sha1($mdp)]);
        return $result;
    }
    // public function getClient($id){
    //     $result = DB::select('SELECT * FROM client WHERE id = ?' , [$id]);
    //     return $result;
    // }

    // public function ModifierInfosClient($id, $nom, $prenom, $contact){
    //     DB::table('client')
    //         ->where('id',$id),
    //         ->update([
    //             'nom' => $nom,
    //             'prenom' => $prenom,
    //             'contact' => $contact
    //         ]);
    // }
}
