<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\Console\Input\Input;

class ReservationController extends Controller
{
    //
    public function index(){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        return view('home',[
            'type' => $typetransport
        ]);
    }
    public function choisirDestination($id){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $villes = $reservation->getVille();
        return view('content.destination',[
            'type' => $typetransport,
            'ville' => $villes,
            'idtype' => $id
        ]);
    }
    public function listvoyage(Request $request){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $idtype = $request->input('idtype');
        $position = $request->input('position');
        $destination = $request->input('destination');
        if(empty($position) || !is_numeric($position)  && empty($destination) || !is_numeric($destination)){
            $message = "Choissiser un ville de depart et destination";
            $villes = $reservation->getVille();
            return view('content.destination',[
                'type' => $typetransport,
                'ville' => $villes,
                'idtype' => $idtype,
                'message' => $message
            ]);
        }else{
            if($position == $destination){
                $message = "Erreur position identique à la destination";
                $villes = $reservation->getVille();
                return view('content.destination',[
                    'type' => $typetransport,
                    'ville' => $villes,
                    'idtype' => $idtype,
                    'message' => $message
                ]);
            }else{
                // current date
                $currentDateTime = Carbon::now()->toDateTimeString();
                $villeDepart = $reservation->getNomVille($position);
                $villeDestination = $reservation->getNomVille($destination);
                $voaygeDispo = $reservation->getVoyageDispo($idtype,$position,$destination,$currentDateTime);
                return view('content.voyage',[
                    'type' => $typetransport,
                    'dispo' => $voaygeDispo,
                    'depart' => $villeDepart,
                    'destination' => $villeDestination
                ]);
            }
        }
    }
    public function getPlace($idvoyage){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $idbus = $reservation->getIdBusVoyage($idvoyage);
        $ToutPlaces = $reservation->getPlace();
        $PlacesIndispo = $reservation->getPlaceIndispo($idvoyage);
        return view('content.place',[
            'type' => $typetransport,
            'places' => $ToutPlaces,
            'PlaceIndispo' => $PlacesIndispo,
            'idvoyage' => $idvoyage
        ]);
    }
    public function Ajouter(Request $request){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $taille = $request->input('taille');
        $idvoyage = $request->input('idvoyage');
        $PlaceAjoutReservation = [];
        for($i=0;$i<$taille ; $i++){
            $indice = $request->input('indice'.$i);
            array_push($PlaceAjoutReservation,$indice);
        }
        $prix = $reservation->getPrixVoyage($idvoyage);
        $totalPrix = $prix * $taille;
        //client
        $idclient = session('idclient');
        $client = $reservation->getClientById($idclient);
        return view('content.paiement',[
            'type' => $typetransport,
            'PlaceAjoutReservation' => $PlaceAjoutReservation,
            'idvoyage' => $idvoyage,
            'prixunitaire' => $prix,
            'totalPrix' => $totalPrix,
            'nombreplace' => $taille,
            'client' => $client
        ]);
    }
    public function validation(Request $request){
        $reference = $request->input('reference');
        $PlaceAjoutReservation = $request->input('PlaceAjoutReservation');
        $idvoyage = $request->input('idvoyage');
        $prixunitaire = $request->input('prixunitaire');
        $totalPrix = $request->input('totalPrix');
        $nombreplace = $request->input('nombreplace');
        //client
        $idclient = session('idclient');
        //
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $client = $reservation->getClientById($idclient);
        if(empty($reference)){
            $message = "Le champ reference est vide";
            $client = $reservation->getClientById($idclient);
            return view('content.paiement',[
                'type' => $typetransport,
                'PlaceAjoutReservation' => $PlaceAjoutReservation,
                'idvoyage' => $idvoyage,
                'prixunitaire' => $prixunitaire,
                'totalPrix' => $totalPrix,
                'nombreplace' => $nombreplace,
                'client' => $client,
                'message' => $message
            ]);
        }else{
            $sms = $reservation->chekSms($reference);
            if(!empty($sms)){
                if($totalPrix == $sms->argent){
                    if($request->has('submit')) {
                        // current date
                        $currentDateTime = Carbon::now()->toDateTimeString();
                        $dataReservation = array(
                            'idclient' => $idclient,
                            'idvoyage' => $idvoyage,
                            'argent' => $totalPrix,
                            'daty' => $currentDateTime
                        );
                        $reservation->insererReservation($dataReservation);
                        $idReservation = $reservation->getIdReservation($idclient,$idvoyage,$totalPrix);
                        for($i=0 ; $i<count($PlaceAjoutReservation) ; $i++){
                            $data = array(
                                'idreservation' => $idReservation,
                                'idplace' => $PlaceAjoutReservation[$i]
                            );
                            $reservation->insererDetailReservation($data);
                        }
                        return redirect()->route('facturation')->with([
                            'PlaceAjoutReservation' => $PlaceAjoutReservation,
                            'prixunitaire' => $prixunitaire,
                            'totalPrix' => $totalPrix,
                            'nombreplace' => $nombreplace,
                            'idvoyage' => $idvoyage,
                            'idReservation' => $idReservation
                        ]);
                    }else{
                        $message = "Veuillez réexécuter la tâche.";
                        $client = $reservation->getClientById($idclient);
                        return view('content.paiement',[
                        'type' => $typetransport,
                        'PlaceAjoutReservation' => $PlaceAjoutReservation,
                        'idvoyage' => $idvoyage,
                        'prixunitaire' => $prixunitaire,
                        'totalPrix' => $totalPrix,
                        'nombreplace' => $nombreplace,
                        'client' => $client,
                        'message' => $message
                        ]);
                    }
                }else{
                    $message = "L'argent reçu ne correspond pas au montant des frais.";
                    $client = $reservation->getClientById($idclient);
                    return view('content.paiement',[
                    'type' => $typetransport,
                    'PlaceAjoutReservation' => $PlaceAjoutReservation,
                    'idvoyage' => $idvoyage,
                    'prixunitaire' => $prixunitaire,
                    'totalPrix' => $totalPrix,
                    'nombreplace' => $nombreplace,
                    'client' => $client,
                    'message' => $message
                ]);
                }
            }else{
                $message = "La référence spécifiée n'existe pas dans la base de données";
                $client = $reservation->getClientById($idclient);
                return view('content.paiement',[
                    'type' => $typetransport,
                    'PlaceAjoutReservation' => $PlaceAjoutReservation,
                    'idvoyage' => $idvoyage,
                    'prixunitaire' => $prixunitaire,
                    'totalPrix' => $totalPrix,
                    'nombreplace' => $nombreplace,
                    'client' => $client,
                    'message' => $message
                ]);
            }
        }
    }
    ///commentaire
    public function Commentaire(){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        return view('content.commentaire',[
            'type' => $typetransport
        ]);
    }
    public function EcritCommentaire(Request $request){
        $coms = $request->input('coms');
        $idclient = session('idclient');
        // current date
        $currentDateTime = Carbon::now()->toDateTimeString();
        $data = array(
            'idclient' => $idclient,
            'coms' => $coms,
            'daty' => $currentDateTime
        );
        $reservation = new Reservation();
        $ecritComs = $reservation->EcritComs($data);
        return redirect()->route('home');
    }
    public function afficherFacturation(){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $idclient = session('idclient');
        //
        $client = $reservation->getClientById($idclient);
        $PlaceAjoutReservation = session('PlaceAjoutReservation');
        $prixunitaire = session('prixunitaire');
        $totalPrix = session('totalPrix');
        $nombreplace = session('nombreplace');
        $idvoyage = session('idvoyage');
        $idReservation = session('idReservation');
        $ClientReservation = $reservation->getReservationById($idReservation);
        $voyage = $reservation->DateDepartVilleDepartArriveParIdVoyage($idvoyage);
        return view('content.facturation',[
            'type' => $typetransport,
            'PlaceAjoutReservation' => $PlaceAjoutReservation,
            'totalPrix' => $totalPrix,
            'ClientReservation' => $ClientReservation,
            'client' => $client,
            'voyage' =>$voyage
        ]);
    }
    public function exportationPpdf(Request $request){
        $reservation = new Reservation();
        $typetransport = $reservation->getTypeTransport();
        $data=array(
            'dateReservation' => $request->input('dateReservation'),
            'nom' => $request->input('nom'),
            'prenoms' => $request->input('prenoms'),
            'contact' => $request->input('contact'),
            'arrive' => $request->input('arrive'),
            'depart' => $request->input('depart'),
            'totalPrix' => $request->input('totalPrix'),
            'datedepart' => $request->input('datedepart'),
            'PlaceAjoutReservation' => $request->input('PlaceAjoutReservation')
        );
        $pdf = Pdf::loadView('pdf.facture',$data);
        return $pdf->download('facture.pdf');
    }
}
