@include('template.header')
<section class="why_section layout_padding">
    <div class="container">
        <form action="{{ url('/exportPdf') }}" method="GET">
            @csrf
            <div class="heading_container heading_center">
                <h5>TransCo Madagascar</h5>
                <h5>Cooperative de Transport</h5>
                <input type="hidden" name="dateReservation" value="{{ $ClientReservation->daty }}">
                <h5>{{ $ClientReservation->daty }}</h5>
                <h5>NIF: 20 042 010 50</h5>
                <h5>STAT: 66303 12 2020 001029</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table text-center" border="1">
                        <tr>
                            <td>Nom</td>
                            <input type="hidden" name="nom" value="{{ $client->nom }}">
                            <td>{{ $client->nom }}</td>
                        </tr>
                        <tr>
                            <td>Prenoms</td>
                            <input type="hidden" name="prenoms" value="{{ $client->prenoms }}">
                            <td>{{ $client->prenoms }}</td>
                        </tr>
                        <tr>
                            <td>Coordonnées</td>
                            <input type="hidden" name="contact" value="{{ $client->contact }}">
                            <td>{{ $client->contact }}</td>
                        </tr>
                        <tr>
                            <td>Voyage</td>
                            <input type="hidden" name="arrive" value="{{ $voyage->arrive }}">
                            <input type="hidden" name="depart" value="{{ $voyage->depart }}">
                            <td>{{ $voyage->depart }}-{{ $voyage->arrive }}</td>
                        </tr>
                        <tr>
                            <td>Frais</td>
                            <input type="hidden" name="totalPrix" value="{{ $totalPrix }}">
                            <td>{{ $totalPrix }} Ar</td>
                        </tr>
                        <tr>
                            <td>Depart</td>
                            <input type="hidden" name="datedepart" value="{{ $voyage->datedepart }}">
                            <td>{{ $voyage->depart }} le {{ $voyage->datedepart }}</td>
                        </tr>
                        <tr>
                            <td>Place(s)</td>
                            <td>
                                @foreach($PlaceAjoutReservation as $place)
                                    <input type="hidden" name="PlaceAjoutReservation[]" value="{{ $place }}">
                                    {{ $place }},
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
             </div>
             <div class="heading_container heading_center">
                Contact : Telma : 0346940402 Orange : 0324534564 Airtel : 0333456789
                <h4>"Tout pour trouver son bonheur de voyager"</h4>
                <button class="btn btn-success" type="submit">Export PDF</button>
             </div>
        </form>
    </div>
</section>
@include('template.footer')
