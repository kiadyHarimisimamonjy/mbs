@extends('layouts.theme')


@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <h3>{{$title}}</h3>

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
                          <a class="btn btn-secondary" href="{{ route('checkouts.show',$id) }}"> Retour</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($by==='paie')
                            <table id="example2" class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Demandeur</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $paie)
                                <tr>
                                    <td>{{explode(' ', $paie->user->name)[0]  }}</td>
                                    <td>{{ number_format($paie->montant, 0, ',', ' ')}} Ar</td>
                                    <td>{{
                                   $paie->created_at}} </td>

                                    <td>
                                        <a class="btn btn-primary" href="{{ route('reservations.show',$paie->reservation->id) }}">
                                       voir
                                        </a>


                                    </td>
                              </tr>
                              @endforeach

                        </table>
                        @endif
                           @if ($by==='annulation')
                            <table id="example2" class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Demandeur</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $paie)
                                <tr>
                                    <td>{{explode(' ', $paie->user->name)[0]  }}</td>
                                    <td>{{ number_format($paie->montant, 0, ',', ' ')}} Ar</td>
                                    <td>{{
                                   $paie->created_at}} </td>

                                    <td>
                                        <a class="btn btn-primary" href="{{ route('reservations.show',$paie->reservation->id) }}">
                                       voir
                                        </a>


                                    </td>
                              </tr>
                              @endforeach

                        </table>
                        @endif
                           @if ($by==='depense')
                            <table id="example2" class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Etat</th>
                                    <th>Demandeur</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Objet</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $depense)
                                <tr>
                                    <td>{{ $depense->etat }}</td>
                                    <td>{{explode(' ', $depense->user->name)[0]  }}</td>
                                    <td>{{ number_format($depense->montant, 0, ',', ' ')}} Ar</td>
                                    <td>{{
                                    date('d-m-Y', strtotime($depense->created_at))}} </td>
                                    <td>{{ substr($depense->commentaire , 0, 10)}}...</td>

                                    <td>
                                        <a class="btn btn-primary" href="{{ route('depenses.show',$depense->id) }}">
                                       voir
                                        </a>
                                        @if ( $depense->user_id===Auth::user()->id && $depense->etat==="en attente")
                                        <a class="btn btn-success" href="{{ route('depenses.edit',$depense->id) }}">
                                            modifier
                                             </a>
                                        @endif

                                    </td>
                              </tr>
                              @endforeach

                        </table>
                        @endif

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
