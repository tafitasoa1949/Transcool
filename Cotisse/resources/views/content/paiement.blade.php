@include('template.header')
<section class="inner_page_head">
    <div class="container_fuild">
       <div class="row">
          <div class="col-md-12">
             <div class="full">
                <h4>Methode de paiement</h4>
                <h5>Telma : 0346940402 Orange : 0324534564 Airtel : 0333456789</h5>
             </div>
          </div>
       </div>
    </div>
 </section>
 <section class="why_section layout_padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-8 offset-lg-2">
             <div class="full">
                <form action="{{ url('/validationReservation') }}" method="GET">
                   <fieldset>
                    @csrf
                        <input type="hidden" name="idvoyage" id="idvoyage" value="{{ $idvoyage }}">
                        <p>Nom : <b>{{ $client->nom }}</b></p>
                        <p>Prenoms : <b>{{ $client->prenoms }}</b></p>
                        <input type="hidden" name="nombreplace" id="nombreplace" value="{{ $nombreplace }}">
                        <p>Nombre de place a reserver : <b>{{ $nombreplace }} place(s)</b></p>
                        <p>Numero de place(s) :
                            <b>
                            @for ($i=0 ; $i < count($PlaceAjoutReservation) ; $i++)
                                <input type="hidden" name="PlaceAjoutReservation[]" id="PlaceAjoutReservation" value="{{ $PlaceAjoutReservation[$i] }}">
                                {{ $PlaceAjoutReservation[$i] }},
                            @endfor
                            </b>
                        </p>
                        <input type="hidden" name="prixunitaire" id="prixunitaire" value="{{ $prixunitaire }}">
                        <p>Prix par place : <b>{{ $prixunitaire }} Ar</b></p>
                        <input type="hidden" name="totalPrix" id="totalPrix" value="{{ $totalPrix }}">
                        <p>Total Motant a payer : <b>{{ $totalPrix }} Ar</b></p>
                        <p>Reference transaction</p>
                        <input type="number" name="reference" placeholder="Reference de transfert">
                        <p class="text-warning"><b>NB : N'oublie pas d'inclure les frais de transfert lors de l'envoi d'argent.</b></p>
                        @if (@!empty($message))
                            <p><h4 class="message">{{ $message }}</h4></p>
                        @endif
                        <input type="submit" value="Accepter" name="submit">
                   </fieldset>
                </form>
             </div>
          </div>
       </div>
    </div>
 </section>

