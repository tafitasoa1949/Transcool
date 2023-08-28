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
                                <h2 class="text-muted">Listes des clients</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th>Prenoms</th>
                                            <th>CIN</th>
                                            <th>Contact</th>
                                            <th>Reservation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $indice)
                                            <tr>
                                                <td>{{ $indice->nom }}</td>
                                                <td>{{ $indice->prenoms }}</td>
                                                <td>{{ $indice->cin }}</td>
                                                <td>{{ $indice->contact }}</td>
                                                <td><a href="{{ url('voirReservation/'.$indice->id) }}" class="btn btn-info" id="reserve">Voir detail</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
@include('template.footer')
