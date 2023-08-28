<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        h3{
            text-align: center;
        }
        h2{
            text-align: center;
        }
        table{
            width: 550px;
            margin-left: 70px;
        }
        td{
            height: 30px;
        }
    </style>
    <title>Facture</title>
</head>
<body>
    <h3>TransCo Madagascar</h3>
    <h3>Cooperative de Transport</h3>
    <h3>{{ $dateReservation }}</h3>
    <h3>NIF: 20 042 010 50</h3>
    <h3>STAT: 66303 12 2020 001029</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <tbody>
            <tr>
                <td>Nom</td>
                <td>{{ $nom }}</td>
            </tr>
            <tr>
               <td>Prenoms</td>
               <td>{{ $prenoms }}</td>
           </tr>
           <tr>
               <td>Coordonnées</td>
               <td>{{ $contact }}</td>
           </tr>
           <tr>
               <td>Voyage</td>
               <td>{{ $depart }}-{{ $arrive }}</td>
           </tr>
           <tr>
               <td>Frais</td>
               <td>{{ $totalPrix }}</td>
           </tr>
           <tr>
               <td>Depart</td>
               <td>{{ $depart }} le {{ $datedepart }}</td>
           </tr>
           <tr>
               <td>Place(s)</td>
               <td>
                <?php for($i=0;$i<count($PlaceAjoutReservation) ; $i++){ ?>{{ $PlaceAjoutReservation[$i] }},<?php } ?>
               </td>
           </tr>
        </tbody>
    </table>
    <h3>Contact : Telma : 0346940402 Orange : 0324534564 Airtel : 0333456789</h3>
    <h2>"Tout pour trouver son bonheur de voyager"</h2>
</body>
</html>
