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
{{  json_encode($inputs,TRUE)}}
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

                                        <select class="form-control col col-md-3 mx-3" name="itinerary" >
                                            <option value="all">tous</option>
                                            @foreach ( $itineraries as   $itinerary)
                                            <option value=" {{$itinerary->id}}"  >{{ $itinerary->name}}</option>
                                            @endforeach
                                        </select>

                                          <input type="date"  name="debut" placeholder="debut" class="form-control col col-md-3" >
                                            <input type="date"   placeholder="fin" name="fin" class="form-control col col-md-3" >



                                </form>
                            </div>

                            <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Destination</th>
                                    <th>depart</th>
                                    <th>cree par</th>
                                    <th>etat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($travels as $travel)
                                <tr>
                                    <td>{{ $travel->id }}</td>
                                    <td>{{ $travel->itinerary->name }}</td>
                                    <td>{{
                                    date('d-m-Y', strtotime($travel->date))}} {{ $travel->hour }}</td>
                                    <td>{{ $travel->user->name }}</td>
                                    <td class="no-print">
                                        @if (date("Y-m-d") >$travel->date)
                                             @if ( $travel->canceled===1)
                                            annule definitif
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
                                        <div class="btn btn-primary " title="modifier">
                                        <i class="nav-icon fas fa-edit">voir</i>
                                         </div>
                                    </td>
                              </tr>
                              @endforeach
                            <tfoot>
                                {!! $travels->links() !!}</tfoot>
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


    {!! $travels->links() !!}


@endsection
