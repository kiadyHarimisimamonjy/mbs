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
                                <form action="{{ route('reservations.index') }}" method="GET">
                                     <b> <button class="btn btn-info" type="submit"><i class="fa fa-search fa-fw"></i> Recherche</button> </b>

                                        <select class="form-control col col-md-2 mx-2" name="itinerary" >
                                            <option value="all">tous</option>
                                            @foreach ( $itineraries as   $itinerary)
                                            <option value=" {{$itinerary->id}}"  >{{ $itinerary->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text"  name="nom" placeholder="nom" class="form-control col col-md-2 mx-2" >



                                          <input type="date"  name="debut" placeholder="debut" class="form-control col col-md-2 mx-2" >
                                            <input type="date"   placeholder="fin" name="fin" class="form-control col col-md-2 mx-2" >



                                </form>
                            </div>

                            <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Destination</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Places</th>
                                    <th>Guichtier</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->itinerary->name }}</td>
                                    <td>{{ $reservation->customer}}</td>
                                    <td>{{
                                    date('d-m-Y', strtotime($reservation->created_at))}} </td>
                                    <td>{{ $reservation->number }}</td>
                                    <td>{{ $reservation->user->name }}</td>

                                    <td>
                                        <div class="btn btn-primary " title="modifier">
                                        <i class="nav-icon fas fa-edit">voir</i>
                                         </div>
                                    </td>
                              </tr>
                              @endforeach
                            <tfoot>
                                {!! $reservations->links() !!}</tfoot>
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


    {!! $reservations->links() !!}


@endsection
