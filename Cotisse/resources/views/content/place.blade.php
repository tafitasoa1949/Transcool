@include('template.header')
<section class="why_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center text-center">
            <h3>Liste des places</h3>
         </div>
        <br>
        <div class="row">
            <div class="col-md-3 mb-3">
                <h3 style="margin-left: 5em">Chauffeur</h3>
            </div>
            <div class="col-md-3 mb-3">
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(1)" id="1" name="1">Place n°1</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(2)" id="2" name="2">Place n°2</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(3)" id="3" name="3">Place n°3</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(4)" id="4" name="4">Place n°4</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(5)" id="5" name="5">Place n°5</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(6)" id="6" name="6">Place n°6</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(7)" id="7" name="7">Place n°7</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(8)" id="8" name="8">Place n°8</button>
            </div>
            <div class="col-md-3 mb-3">
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(9)" id="9" name="9">Place n°9</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(10)" id="10" name="10">Place n°10</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(11)" id="11" name="11">Place n°11</button>
            </div>
            <div class="col-md-3 mb-3">
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(12)" id="12" name="12">Place n°12</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(13)" id="13" name="13">Place n°13</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(14)" id="14" name="14">Place n°14</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(15)" id="15" name="15">Place n°15</button>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-secondary" onclick="buttonClicked(16)" id="16" name="16">Place n°16</button>
            </div>
        </div>
        <div class="heading_container heading_center text-center">
            <form id="form" action="{{ url('/AjoutReservation') }}" method="GET">
                <input type="hidden" name="idvoyage" value="{{ $idvoyage }}">
                <h4 id="champ"></h4>
            </form>
         </div>
    </div>
</section>
@push('scripts')
<script>
    var PlaceIndispo = {!! json_encode($PlaceIndispo) !!};
    var chiffres = []; //numero boutton retra2
    let validerCree = false;
    var ChampValider = document.getElementById('champ');
    var form = document.getElementById('form');
    document.addEventListener('DOMContentLoaded', function() {
        maFonction();
    });
    var boutons = document.querySelectorAll(".btn.btn-secondary");
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
    var count = 0;
    const taille_input = document.createElement('input');
    var numerosCliques = []; // Tableau pour stocker les numéros de boutons cliqués

    function buttonClicked(number) {
        var bouton = document.getElementById(number.toString());

        if (bouton.style.backgroundColor === 'green') {
            // Supprimer la couleur verte et le numéro du tableau numerosCliques
            bouton.style.backgroundColor = '';
            const index = numerosCliques.indexOf(number);
            if (index !== -1) {
                numerosCliques.splice(index, 1);
            }
            count--;
            // Supprimer l'élément input correspondant au bouton
            var inputASupprimer = document.getElementById('indice' + count);
            if (inputASupprimer) {
                inputASupprimer.remove();
                taille_input.setAttribute('value', count);
            }
        } else {
            if (!PlaceIndispo.includes(number) && !numerosCliques.includes(number)) {
            numerosCliques.push(number); // Ajouter le numéro du bouton cliqué au tableau
            // alert("Bouton " + number + " cliqué !");

            if (!validerCree) {
                const valider = document.createElement('input');
                valider.setAttribute('type', 'submit');
                valider.setAttribute('value', 'Reserver');
                valider.setAttribute('style', 'background-color: orange');
                ChampValider.appendChild(valider);
                validerCree = true;

                //nombre de réservations
                taille_input.setAttribute('type', 'hidden');
                taille_input.setAttribute('name', 'taille');
                taille_input.setAttribute('value', count + 1);
                form.appendChild(taille_input);
            }

            const indice = document.createElement('input');
            indice.setAttribute('type', 'hidden');
            indice.setAttribute('id', 'indice' + count);
            indice.setAttribute('name', 'indice' + count);
            indice.setAttribute('value', number);
            form.appendChild(indice);

            bouton.style.backgroundColor = 'green';
            taille_input.setAttribute('value', count + 1);
            count++;
            }
        }
    }

</script>
