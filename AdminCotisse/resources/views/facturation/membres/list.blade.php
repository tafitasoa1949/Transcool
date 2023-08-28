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
                                <h2 class="text-muted">Salaire des employés</h2>
                                <form action="{{ url('salaireMembreParType') }}" method="GET">
                                    <h4>Trier par
                                        <select name="idtype" id="idtype">
                                            <option value="">Choisissez...</option>
                                            @foreach($typesmembres as $row)
                                                <option value="{{ $row->id }}">{{ $row->type }}</option>
                                            @endforeach
                                        </select>
                                        <input type="submit" value="Trier">
                                    </h4>
                                </form>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prenoms</th>
                                            <th>Metier</th>
                                            <th>Salaire</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listmembre as $indice)
                                            <tr>
                                                <td>{{ $indice->nom }}</td>
                                                <td>{{ $indice->prenom }}</td>
                                                <td>{{ $indice->type }}</td>
                                                <td>{{ $indice->salaire }} Ar</td>
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
