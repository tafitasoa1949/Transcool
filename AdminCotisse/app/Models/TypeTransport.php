<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeTransport extends Model
{
    use HasFactory;
    public function insert($nom){
        DB::table('typetransport')->insert([
            'nom' => $nom
        ]);
    }

    public function getList(){
        $result = DB::select("SELECT * FROM typetransport");
        return $result;
    }
    
    public function supprimer($id){
        DB::table('typetransport')
        ->where('id',$id)
        ->delete();
    }
}
