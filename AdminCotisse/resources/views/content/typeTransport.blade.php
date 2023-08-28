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
                                <h2 class="text-muted">Ajouter type transport</h2>
                                <form action="{{ url('/ajouterType') }}" method="GET" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustom01">Nom</label>
                                            <input type="text" name="nom" class="form-control" id="validationCustom01" placeholder="" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <button id="top" class="btn btn-primary" type="submit">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <h2 class="text-muted">Liste type transport</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $indice)
                                            <tr>
                                                <td>{{ $indice->nom }}</td>
                                                <td><a href="" class="btn btn-warning">Modifier</a></td>
                                                <td><a href="{{ url('supprimerType/'.$indice->id) }}" class="btn btn-danger">Supprimer</a></td>
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
