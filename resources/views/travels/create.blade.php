@extends('layouts.theme')


@section('content')
       <!-- Content Wrapper. Contains page content -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <h1>Nouvelle Voyages</h1>
                    </div>
                    <div class="col-sm-6">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                                <form action="{{ route('travels.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"
                                    class="form-control text-center border-secondary" width=200px>
                                    <input type="hidden" name="canceled" value="0">
                                <div class="row px-2 pt-3 m-0 ">
                                    <div class="col-12">
                                        <h5 class="fw-bolder text-secondary text-decoration-underline">Depart</h5>
                                    </div>
                                    <!-- date -->
                                    <div class="col-12 col-sm-6 text-dark mx-2">
                                        <label for="departDate" class="form-label fw-bolder align-text-center">
                                            Date
                                        </label>
                                        <input required type="date" id="departDate" name="date"
                                            class="form-control border-secondary">
                                    </div>
                                    <!-- heure -->
                                    <div class="col-6 col-sm-4 text-dark mx-2">
                                        <label for="departHeure" class="form-label fw-bolder align-text-center">
                                            Heure
                                        </label>
                                        <input type="time" id="departDheure" name="hour"
                                            class="form-control text-center border-secondary" width=200px>
                                    </div>
                                </div>

                                <div class="row px-2 pt-0 m-0 justify-content-space-between">
                                    <div class="col-12 ">
                                        <h5 class="fw-bolder text-secondary text-decoration-underline pt-3">Detail
                                        </h5>
                                    </div>
                                    <!-- point de depart -->
                                    <div class="col-12 col-sm-6 text-dark ">
                                        <label for="Tdepart" class="form-label fw-bolder align-text-center">
                                            trajet :</label>
                                        <select class="form-control" name="itinerary_id" id="Tdepart">
                                            @foreach ( $itineraries as   $itinerary)
                                            <option value=" {{$itinerary->id}}"  >{{ $itinerary->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 text-dark ">
                                        <label for="Bateau" class="form-label fw-bolder align-text-center">
                                            Bateau :</label>
                                        <select class="form-control" name="boat_id" id="Bateau">
                                            @foreach ( $boats as   $boat)
                                            <option value=" {{$boat->id}}"  >{{ $boat->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <!-- voyage -->




                                </div>

                                <div
                                    class="row px-2 pt-1 m-0 align-items-center justify-content-space-between justify-content-center mt-2">
                                    <a class="btn btn-secondary" href="{{ route('home') }}" > Annuler</a>



                                        <button type="submit"
                                        class="btn btn-info col-4 text-center fw-bolder mx-2">Enregister</button>


                                </div>
                               </form>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer col-12 justify-content-right">

                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->





@endsection
