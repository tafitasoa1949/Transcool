@include('template.header')
@include('template.sidebar')
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-11 col-lg-11 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <section class="why_section layout_padding">
                                    <div class="container">
                                        <div class="heading_container heading_center text-center">
                                            <h2>Places</h2>
                                         </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <h3 style="margin-left: 5em">Chauffeur</h3>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(1)" id="1" name="1">Place n°1</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(2)" id="2" name="2">Place n°2</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(3)" id="3" name="3">Place n°3</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(4)" id="4" name="4">Place n°4</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(5)" id="5" name="5">Place n°5</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(6)" id="6" name="6">Place n°6</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(7)" id="7" name="7">Place n°7</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(8)" id="8" name="8">Place n°8</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(9)" id="9" name="9">Place n°9</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(10)" id="10" name="10">Place n°10</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(11)" id="11" name="11">Place n°11</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(12)" id="12" name="12">Place n°12</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(13)" id="13" name="13">Place n°13</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(14)" id="14" name="14">Place n°14</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(15)" id="15" name="15">Place n°15</button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-ligth" onclick="buttonClicked(16)" id="16" name="16">Place n°16</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-11 col-lg-11 col-md-6 col-sm-12 col-12">
                        <div class="col-mg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="heading_container heading_center text-center">
                                        <h2>Client</h2>
                                     </div>
                                   <div id="gauche">
                                        <h4>Nom : {{ $detail->nom }}</h4>
                                        <h4>Prenoms : {{ $detail->prenoms }}</h4>
                                        <h4>Coordonnées : {{ $detail->contact }}</h4>
                                        <h4>Voyage : {{ $detail->depart }} - {{ $detail->arrive }}</h4>
                                        <h4>Frais : {{ $detail->prix }} Ar</h4>
                                        <h4>Depart : {{ $detail->depart }}</h4>
                                        <h4>Date : {{ $detail->daty }}</h4>
                                   </div>
                                   <div id="droite">
                                        <img src="{{ asset('assets/images/sary.png') }}" alt="" id="sary">
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var PlaceIndispo = {!! json_encode($listeplace) !!};
    var chiffres = []; //numero boutton retra2
    var form = document.getElementById('form');
    document.addEventListener('DOMContentLoaded', function() {
        maFonction();
    });
    var boutons = document.querySelectorAll(".btn.btn-ligth");
    boutons.forEach(function(bouton) {
        var chiffre = parseInt(bouton.id);
        if (!isNaN(chiffre)) {
            chiffres.push(chiffre);
        }
    });
    function maFonction() {
        for(var i=0 ; i< chiffres.length ; i++){
            var chiffre = chiffres[i];
            if (PlaceIndispo.includes(chiffre)) {
            var bouton = document.getElementById(chiffre.toString());
                bouton.setAttribute('style','background-color:red');
               console.log(bouton);
            }
        }
    }
</script>
<!-- ============================================================== -->
@include('template.footer')
