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
                                <h2 class="text-muted">Listes des avis des clients pour notre site</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prenoms</th>
                                            <th>Commentaire</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listplaintes as $indice)
                                            <tr>
                                                <td>{{ $indice->nom }}</td>
                                                <td>{{ $indice->prenoms }}</td>
                                                <td>{{ $indice->coms }}</td>
                                                <td>{{ $indice->daty }}</td>
                                                <td><a href="" class="btn btn-secondary">Envoyer un email</a></td>
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
