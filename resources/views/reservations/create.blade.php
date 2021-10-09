@extends('layouts.theme')


@section('content')
       <!-- Content Wrapper. Contains page content -->


            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <h1>Ouverture De Caisse</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h1 class="card-title fw-bold">Formulaire</h1>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                                    </div>
                                </div>
                                <div class="card-body">
                        <div id="error" class="col-12" class="alert alert-danger">
                            <strong>remlpissez le Formulaire dans l'ordre</strong>
                        </div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

  <input type="hidden" id="user_id" value="{{ Auth::user()->id }}"
                                 >


                                    <div class="row pt-3 m-0 ">
                                        <div class="col-4">
                                            <label for="placeDisponibe" class="form-label fs-6 fw-bolder align-text-center">
                                                <img src="" alt=""> Place Restant
                                            </label>
                                            <input readonly type="text" id='placeDisponibe'
                                                class="form-control text-center border-secondary" value="0">
                                        </div>
                                        <div class="col-4">

                                        </div>
                                        <div class="col-4">
                                            <label for="total" class="form-label fs-6 fw-bolder align-text-center">
                                                <img src="" alt=""> Net a payee
                                            </label>
                                            <input readonly type="text" id='total'
                                                class="form-control text-center border-secondary" value="0">

                                        </div>
                                        <!-- itin -->
                                        <div class="col-3 col-sm-3  ext-dark mx-2">
                                            <label for="itin" class="form-label fw-bolder align-text-center">
                                                <img src="../asset/icon/globe.svg" alt=""> Itineraire
                                            </label>
                                            <select class="col-12 form-control" id="itinerary" onchange="getTravel ()" name="itin">
                                                <option >  </option>
                                            @foreach ( $itineraries as   $itinerary)
                                            <option value=" {{$itinerary}}"  >{{ $itinerary->name}}</option>
                                            @endforeach
                                            </select>

                                        </div>
                                        <div class="col-3 col-sm-3  ext-dark mx-2">
                                            <label for="itin" class="form-label fw-bolder align-text-center">
                                                <img src="../asset/icon/globe.svg" alt=""> Bateau
                                            </label>
                                            <select class="col-12 form-control"  onchange="getTravel ()" id="boat" >
                                                @foreach ( $boats as   $boat)
                                                <option value=" {{$boat->id}}"  >{{ $boat->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <!-- date -->
                                        <div class="col-2 col-sm-2 col-md text-dark mx-2">
                                            <label for="departdate" class="form-label fw-bolder align-text-center">
                                                <img src="../asset/icon/alarm.svg" alt=""> Date
                                            </label>
                                            <select class="col-12 form-control text-center border-secondary"
                                                id="departdate" name="travel_id">

                                            </select>
                                        </div>
                                        <!-- heure -->
                                        <div class="col-2 col-sm-2  col-md text-dark mx-2">
                                            <label for="departHeure" class="form-label fw-bolder align-text-center">
                                                <img src="" alt=""> Heure
                                            </label>
                                            <input class="col-12 form-control text-center border-secondary"
                                               disabled id="hour" name="itin"/>

                                        </div>

                                    </div>
                                    <div class="row pt-3 m-0 ">
                                        <div class="col-2 col-sm-2 text-dark mx-2">
                                            <label for="numv" class="form-label fs-6 fw-bolder align-text-center">
                                                Nombre
                                            </label>
                                            <input  type="number" id='nombre'  oninput="changeNumber()" value="1"
                                                class="form-control text-center border-secondary" >
                                        </div>

                                        <div class="col-4 text-dark">
                                            <label for="cin" class="form-label fw-bolder align-text-center">
                                                <img src="../asset/icon/person.svg" alt="">Nom :</label>
                                            <input type="text" id='nom' class="form-control border-secondary">

                                        </div>

                                        <!-- Contact -->
                                        <div class="col-3 col-sm-2 text-dark mx-2">
                                            <label for="contact"
                                                class="form-label fw-bolder align-text-center">Contact:</label>
                                            <input type="text" id='contact' class="form-control border-secondary">

                                        </div>
                                        <div class="col-2 col-sm-2 text-dark mx-2">
                                            <label for="prix" class="form-label fs-6 fw-bolder align-text-center">
                                                <img src="" alt=""> Prix Unitaire
                                            </label>
                                            <input readonly type="text" id='prix'
                                                class="form-control text-center border-secondary" value="0">
                                        </div>
                                          <!-- provenance -->
                                          <div class="form-group clearfix m-2 col-12">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio"  value='national' name="tarif" checked id="radioSuccess1">
                                                <label for="radioSuccess1">
                                                    Resident
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio"  value='foreigner' name="tarif" id="radioSuccess2">
                                                <label for="radioSuccess2">
                                                    Etranger
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <h5 class="fw-bold fs-2 text-secondary text-decoration-underline pt-3">Info
                                            Client </h5>
                                    </div>
                                    <div id="clientInsert" class="col-12 ">
                                        <div class="block row">
                                                <!-- nom compelt -->
                                                <div  class=" form-group col-5 text-dark mx-1">
                                                    <input type="text"   id='nomclient' placeholder="Nom complet 1" class="nomclient form-control border-secondary">

                                                </div>
                                                <!-- cin -->
                                                <div class="form-group col-5 text-dark">
                                                        <input type="text" id='cin'  placeholder="CIN"   class="cin form-control border-secondary">

                                                </div>

                                                <!-- Contact -->
                                                <div class="form-group col-1 text-dark mx-auto">
                                                </div>
                                        </div>
                                    </div>


                                </div>



                        <!-- /.card-body -->
                        <div class="card-footer col-12 justify-content-right">
                            <button onclick="submit('save')" class="btn btn-success">Enregistrer</button>
                            @if (!$isadmin)
                            <button onclick="submit('saveandpaid')" class="btn btn-danger">Enregistrer et Payer</button>

                            @endif

                            <a class="btn btn-secondary" href="{{ route('home') }}" > Retour</a>

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.card -->
        </div>

    </section>


@endsection
