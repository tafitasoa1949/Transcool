@include('template.header')
@include('template.sidebar')
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted">Ajouter bus</h2>
                                <form action="{{ url('/ajouterBus') }}" method="GET" class="needs-validation">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustom01">Nom</label>
                                            <input type="text" name="nom" class="form-control" id="validationCustom01" placeholder="" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label id="top" for="validationCustom01">Vehicule</label>
                                            <select name="idtypetransport" id="idtypetransport" class="form-control" required>
                                                <option value="">Choisissez un ...</option>
                                                @foreach ($listType as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <button id="top" class="btn btn-primary" type="submit">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <h2 class="text-muted">Liste bus</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th>Vehicule</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $indice)
                                            <tr>
                                                <td>{{ $indice->nom }}</td>
                                                <td>{{ $indice->vehicule }}</td>
                                                <td><a href="" class="btn btn-warning">Modifier</a></td>
                                                <td><a href="{{ url('supprimerBus/'.$indice->id) }}" class="btn btn-danger">Supprimer</a></td>
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
