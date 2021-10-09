@extends('layouts.theme')


@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Fermeture Caisse</h1>
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
                                <form action="{{ route('checkouts.opened') }}" method="GET">
                                     <b> <button class="btn btn-info" type="submit"><i class="fa fa-search fa-fw"></i> Recherche</button> </b>
                                    @if ($isadmin)

                                   <select class="form-control col col-md-2 mx-2" name="counter" >
                                            <option value="all">tous</option>
                                        @foreach ( $counters as   $counter)
                                            <option value=" {{$counter->id}}"  >{{ $counter->name}}</option>
                                            @endforeach
                                        </select>

                                    @endif


                                        <input type="text"  name="nom" placeholder="nom" class="form-control col col-md-2 mx-2" >



                                          <input type="date"  name="debut" placeholder="debut" class="form-control col col-md-2 mx-2" >
                                            <input type="date"   placeholder="fin" name="fin" class="form-control col col-md-2 mx-2" >



                                </form>
                            </div>
                            <thead>
                                <tr>
                                    <th>Caisse</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Saisi</th>
                                    <th>Calcule</th>
                                    <th>Decalage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkouts as $checkout)
                                <tr>
                                    <td>
                                       {{$checkout->checkout_open->counter->name}}

                                    </td>
                                    <td>{{explode(' ', $checkout->user->name)[0]  }}</td>
                                    <td>{{
                                    date('d-m-Y', strtotime($checkout->created_at))}} </td>
                                    <td>{{ number_format($checkout->constate, 0, ',', ' ')}} Ar</td>
                                    <td>
                                        {{ number_format($checkout->calcule, 0, ',', ' ')}} Ar
                                    </td>
                                    <td>
                                         {{ number_format($checkout->decalage, 0, ',', ' ')}} Ar
                                    </td>

                                    <td>
                                        <a class="btn btn-primary" href="{{ route('checkouts.show',$checkout->checkout_open->id) }}">
                                       voir
                                        </a>


                                    </td>
                              </tr>
                              @endforeach

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
    {!! $checkouts->links('pagination::bootstrap-4') !!}
</section>
<!-- /.content -->





@endsection
