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
                                <h2 class="text-muted">Listes des reservations</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Client</th>
                                            <th>Depart</th>
                                            <th>Arivée</th>
                                            <th>Nbr de place</th>
                                            <th>Methode</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $indice)
                                            <tr>
                                                <td>{{ $indice['client'] }}</td>
                                                <td>{{ $indice['depart'] }}</td>
                                                <td>{{ $indice['arrive'] }}</td>
                                                <td>{{ $indice['nbr'] }}</td>
                                                <td>{{ $indice['methode'] }}</td>
                                                <td>{{ $indice['daty'] }}</td>
                                                <td><a href="{{ url('detail/'.$indice['id']) }}" class="btn btn-warning" id="reserve">Detail</a></td>
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
