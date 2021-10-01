@extends('layouts.theme')


@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listes des voyages</h1>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <div class="search row pb-2">
                                <form action="{{ route('travels.index') }}" method="GET">
                                     <b> <button class="btn btn-info" type="submit"><i class="fa fa-search fa-fw"></i> Recherche</button> </b>

                                        <select class="form-control col col-md-2 mx-2" name="itinerary" >
                                            <option value="all">tous</option>
                                            @foreach ( $itineraries as   $itinerary)
                                            <option value=" {{$itinerary->id}}"  >{{ $itinerary->name}}</option>
                                            @endforeach
                                        </select>
                                        <select class="form-control col col-md-2 mx-2" name="boat" >
                                            <option value="all">tous</option>
                                            @foreach ( $boats as   $boat)
                                            <option value=" {{$boat->id}}"  >{{ $boat->name}}</option>
                                            @endforeach
                                        </select>


                                          <input type="date"  name="debut" placeholder="debut" class="form-control col col-md-2 mx-2" >
                                            <input type="date"   placeholder="fin" name="fin" class="form-control col col-md-2 mx-2" >



                                </form>
                            </div>

                            <thead>
                                <tr>
                                    <th>Destination</th>
                                    <th>Bateau</th>
                                    <th>Depart</th>
                                    <th>Cree par</th>
                                    <th>Etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($travels as $travel)
                                <tr>
                                    <td>{{ $travel->itinerary->name }}</td>
                                    <td>{{ $travel->boat->name }}</td>
                                    <td>{{
                                    date('d-m-Y', strtotime($travel->date))}} {{ $travel->hour }}</td>
                                    <td>{{ explode(' ',$travel->user->name )[0] }}</td>
                                    <td class="no-print">
                                        @if (date("Y-m-d") >$travel->date)
                                             @if ( $travel->canceled===1)
                                            annule

                                            @else
                                              acheve
                                            @endif

                                        @else
                                            @if ( $travel->canceled===1)
                                            annule
                                            @else
                                               en cours
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('travels.show',$travel->id) }}">
                                            voir
                                            </a>
                                            @if (!(date("Y-m-d") >$travel->date) && $travel->canceled===0)
                                            <a class="btn btn-danger" href="{{ route('travels.postpone',$travel->id) }}">
                                               Reporte
                                                </a>
                                                @endif
                                    </td>
                              </tr>
                              @endforeach
                            <tfoot>
                                {!! $travels->links('pagination::bootstrap-4') !!}</tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->




@endsection
