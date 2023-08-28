@include('template.header')
 <section class="why_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center text-center">
          <h4 style="float: left">Position actuelle : <b style="color: royalblue">{{ $depart }}</b> Destination : <b style="color: royalblue">{{ $destination }}</b></h4>
       </div>
       <div class="row" style="height: 30px"></div>
       <div class="row">
          <div class="col-md-12">
            <table class="table text-center" border="1">
                <thead>
                  <tr>
                    <th scope="col">Date de depart</th>
                    <th scope="col">Vehicule</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Reservation</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dispo as $indice)
                        <tr>
                            <td>{{ $indice->datedepart }}</td>
                            <td>{{ $indice->vehicule }}</td>
                            <td>{{ $indice->prix }} Ar</td>
                            <td><a href="{{ url('reservation/'.$indice->idvoyage) }}">Faire un reservation</a></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
       </div>
    </div>
 </section>
@include('template.footer')
