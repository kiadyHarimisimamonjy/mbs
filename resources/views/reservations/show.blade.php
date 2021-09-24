@extends('layouts.theme')


@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Reservation</h1>
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
                        <div class="card-header">
                         Enregistre le
                            <strong>{{$reservation->created_at}}</strong>
                            <span class="float-right"> <strong>Status:
                                @if ($reservation->canceled===1)
                                   annulle

                                @else
                                    @if ($unpaid>0)
                                        impaye
                                    @else
                                        paye
                                    @endif
                                @endif
                            </strong>
                            </span>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                            <h6 class="mb-3">
                            <strong>Facture N: {{$reservation->id}}</strong>
                            </h6>

                            <div>
                                <strong>Nom Client:</strong>   {{ $reservation->customer}}
                            </div>
                            <div>   <strong>Telephone Client:</strong> {{ $reservation->contact}}</div>
                            <div>  <strong>Nombre De Place :</strong> {{ $reservation->number}}</div>
                            <div>  <strong>Guichetier :</strong> {{ $user->name}}</div>

                            </div>

                            <div class="col-sm-6">
                                <h6 class="mb-3">
                                <strong> {{$itinerary->name}}</strong>
                                </h6>

                            <div> <strong>Bateau:</strong> {{ $travel->boat->name}}</div>
                            <div> <strong> Net à Payer :</strong> {{ $reservation->total}}</div>
                            <div> <strong>Recu :</strong> {{$sumpaid }}</div>
                            <div> <strong>Reste:</strong> {{$unpaid}}</div>

                            </div>



                            </div>
                        <div class="table-responsive-sm">
                            <table id="example2" class="table table-bordered table-hover">

                                <thead>
                                    <tr>
                                        <th>Num</th>
                                        <th>Nom</th>
                                        <th>CIN</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->cin}}</td>

                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-primary">Imprimer</button>

                             @if ($unpaid>0)
                             <a  href="{{ route('reservations.editPaid',$reservation) }}" class="btn btn-success">Payer</a>
                             @endif

                        <button type="button" class="btn btn-danger">Annuler</button>

                    </div>
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
