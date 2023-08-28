<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="{{ url('/') }}">TransCo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form action="{{ url('/recherche') }}" method="GET">
                                <div id="custom-search" class="top-search-bar">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Recherche" name="mots">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Deconnexion</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Administrateur
                            </li>
                            {{--  --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}"  data-target="#submenu-5" aria-controls="submenu-1"><i class="fas fa-fw fa-user"></i>Clients</a>
                            </li>
                            {{--  --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/reservation') }}"  data-target="#submenu-5" aria-controls="submenu-2"><i class="fas fa-fw fa-hands-helping"></i>Reservation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-money-bill-alt"></i>Facturation et Paiement</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/factureClient') }}">Clients</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/salaireMembre') }}">Salaire des membres</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fa fa-fw fa-history"></i>Gestion et Historique</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4-2" aria-controls="submenu-4-2">Membres</a>
                                            <div id="submenu-4-2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                    <!--------------------------------- HISTORIQUE PAR TYPE DE MEMBRE ----------------------------------->
                                                    @foreach($typesmembres as $row)
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ url('/historiqueMembre/'.$row->id) }}">{{ $row->type }}</a>
                                                    </li>
                                                    @endforeach
                                    <!---------------------------------------------------------------------------------------------------->
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <!-- <a class="nav-link" href="dashboard-finance.html">Vehicule</a> -->
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-chart-line"></i>Rapports et Statistiques </a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/revenuMensuel') }}">Revenus mensuel</a>
                                        </li>
                                        <li class="nav-item">
                                            <!-- <a class="nav-link" href="pages/data-tables.html">Membres</a> -->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/statsVehicule') }}">Vehicule</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/plainte') }}"  data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-comments"></i>Gestion des plaintes</a>
                            </li>
                            <li class="nav-divider">
                                Parametres
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/typetransport') }}"  aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-f fa-shipping-fast"></i>Type de Transport</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/bus') }}"  aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-f fa-car"></i>Bus</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/voyage') }}"  aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-f fa-road"></i>Voyage</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- =====================================================
