<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Membre extends Model
{
    use HasFactory;

    public function getTousTypeMembres(){
        $result = DB::select("SELECT * FROM typemembre");
        return $result;
    }

    public function getTypeMembreId($type){
        $sql = "SELECT * FROM typemembre WHERE lower(type) LIKE lower('%$type%')";
        $result = DB::select($sql);
        return $result[0]->id;
    }

    public function getTypeMembre($idtypemembre){
        $result = DB::select('SELECT * FROM typemembre WHERE id=?',[$idtypemembre]);
        return $result[0];
    }

    public function ajouterTypeMembre($type){
        DB::table('typemembre')->insert(['type'=>$type]);
    }

    public function getMembre($idmembre){
        $result = DB::select('SELECT * FROM v_statusmembre WHERE idmembre=?',[$idmembre]);
        return $result[0];
    }

    public function getMembres($idtypemembre){
        $result = DB::select('SELECT * FROM v_statusmembre WHERE idtypemembre=?',[$idtypemembre]);

        return $result;
    }

    private function getNouveauMembreId(){
        $result = DB::select('select getseqmembre() as sequence from generate_series(1,1) AS dummy');
        $idnum = strval($result[0]->sequence);
        $longueur = strlen($idnum);
        $longueurMaxId = 3;

        $id = "MBR";
        for($i = 0; $i<$longueurMaxId-$longueur ; $i++){
            $id .= "0";
        }
        $id .= $idnum;

        return $id;
    }

    public function ajouterNouveauMembre($nom,$prenom,$idtypemembre,$salaire,$datedebut){
        $newid = $this->getNouveauMembreId();
        DB::beginTransaction();
        try{
            DB::table('membre')
            ->insert([
                'id' => $newid,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'idtypemembre'=>$idtypemembre,
                'salaire'=>$salaire
            ]);
            DB::table('statusmembre')->insert(['idmembre' => $newid , 'datedebut' => $datedebut]);

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function modifierMembre($idmembre,$nom,$prenom,$idtypemembre,$salaire,$datedebut){
        DB::beginTransaction();
        try{
            DB::table('membre')
            ->where(['id' => $idmembre])
            ->update([
                'nom'=>$nom,
                'prenom'=>$prenom,
                'idtypemembre'=>$idtypemembre,
                'salaire'=>$salaire
            ]);
            DB::table('statusmembre')->where(['idmembre' => $idmembre])->update(['datedebut' => $datedebut]);

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function demissionerMembre($idmembre,$datefin){
        DB::table('statusmembre')->where(['idmembre' => $idmembre])->update(['datefin'=> $datefin]);
    }

    public function reembaucherMembre($idmembre, $salaire, $datedebut){
        DB::beginTransaction();
        try{
            DB::table('statusmembre')->insert(['idmembre' => $idmembre, 'datedebut' => $datedebut, 'datefin' => null]);
            if($salaire > 0 && $salaire != null && $salaire != ""){
                DB::table('membre')->where(['id' => $idmembre])->update(['salaire' => $salaire]);
            }

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function getMembresActifs($idtypemembre){
        $result = DB::select("SELECT vsm.*
        FROM v_statusmembre AS vsm
        JOIN (
            SELECT MAX(idstatusmembre) AS max_idsm, idmembre
            FROM v_statusmembre
            GROUP BY idmembre
        ) AS last_status
        ON vsm.idstatusmembre = last_status.max_idsm
        WHERE vsm.datefin IS NULL AND idtypemembre=?", [$idtypemembre]);

        foreach($result as $row){
            $row->datedebut = Carbon::parse($row->datedebut)->format('l j F Y');
        }

        return $result;
    }

    public function getAnciensMembres($idtypemembre){
        $result = DB::select("SELECT vsm.*
        FROM v_statusmembre AS vsm
        JOIN (
            SELECT MAX(idstatusmembre) AS max_idsm, idmembre
            FROM v_statusmembre
            GROUP BY idmembre
        ) AS last_status
        ON vsm.idstatusmembre = last_status.max_idsm
        WHERE vsm.datefin IS NOT NULL AND idtypemembre=?", [$idtypemembre]);

        foreach($result as $row){
            $row->datedebut = Carbon::parse($row->datedebut)->format('l j F Y');
            $row->datefin = Carbon::parse($row->datefin)->format('l j F Y');

        }

        return $result;
    }

    //  ------------------------- GRAPHE --------------------------

    public function nombreVoyageJour($idmembre,$jour,$mois,$annee){
        $date = strval($annee)."-".strval($mois)."-".strval($jour);
        $result = DB::select("SELECT count(id) as nombre
            FROM voyage as v
            WHERE date_trunc('day',datedepart)=?
            AND idchauffeur=?", [$date, $idmembre]);

        return $result[0]->nombre;
    }

    // Obtenir la liste des voyages accomplit par un chauffeur
    public function getListesVoyagesJour($idmembre,$jour,$mois,$annee){
        $date = strval($annee)."-".strval($mois)."-".strval($jour);
        $result = DB::select("SELECT id FROM voyage
        WHERE date_trunc('day',datedepart)=?
        AND idchauffeur=?", [$date, $idmembre]);

        return $result;
    }

    public function getGainsJournee($idmembre,$jour,$mois,$annee, $voyage){
        $gains = 0;
        $voyagesAccompli = $this->getListesVoyagesJour($idmembre,$jour,$mois,$annee);
        foreach($voyagesAccompli as $row){
            $gains = $gains + $voyage->getTotalRevenue($row->id);
        }
        return $gains;
    }

    public function nombreVoyageMois($idmembre, $mois, $annee, $graphe){
        $nombreVoyages = [];
        $jours = $graphe->getJoursMois($mois,$annee);
        foreach ($jours as $jour) {
            array_push($nombreVoyages, $this->nombreVoyageJour($idmembre,$jour,$mois,$annee));
        }

        return $nombreVoyages;
    }

    public function listeGainsMois($idmembre,$mois,$annee,$voyage,$graphe){
        $gainsVoyages = [];
        $jours = $graphe->getJoursMois($mois,$annee);
        foreach ($jours as $jour) {
            array_push($gainsVoyages, $this->getGainsJournee($idmembre,$jour,$mois,$annee,$voyage));
        }

        return $gainsVoyages;
    }

    //  -----------------------------------------------------------
    public function getSalaire(){
        $result = DB::select("select m.nom as nom,m.prenom as prenom,t.type as type,m.salaire as salaire from membre as m
        join typemembre as t on t.id=m.idtypemembre");
        return $result;
    }
    public function getSalaireParType($idtype){
        $result = DB::select("select m.nom as nom,m.prenom as prenom,t.type as type,m.salaire as salaire from membre as m
        join typemembre as t on t.id=m.idtypemembre where t.id=".$idtype);
        return $result;
    }
}
