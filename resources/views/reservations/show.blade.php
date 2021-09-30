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
                            <div class="row">
                          <div class="col-4">  <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Liste des clients</h3>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                  <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach ($customers as $customer)
                                    <li class="item">
                                      <div class="product-info">
                                        {{ $customer->name }}
                                            <span class="product-description">
                                                {{ $customer->cin }}
                                        </span>
                                      </div>
                                    </li>
                                    @endforeach
                                  </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                </div>
                                <!-- /.card-footer -->
                              </div>
                              <!-- /.card -->
                            </div>
                            <div class="col-4">
                                 <div class="card">
              <div class="card-header">
                <h3 class="card-title">Historique paie</h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @forelse ($paiements as $paiement)
                    <li class="item">
                        <div class="product-img">
                            {{$paiement->montant}} ar
                          </div>
                        <div class="product-info">
                          {{$paiement->user->name}}
                          <span class="product-description">
                            {{$paiement->created_at}}
                          </span>
                        </div>
                      </li>
                    @empty
                    <li class="item">
                        aucun paiment recu
                        <li>
                    @endforelse


                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-4">
            <div class="card">
<div class="card-header">
<h3 class="card-title">Historique paie</h3>


</div>
<!-- /.card-header -->
<div class="card-body p-0">
<ul class="products-list product-list-in-card pl-2 pr-2">
@forelse ($canceledpaiements as $canceledpaiement)
<li class="item">
   <div class="product-img">
       {{$canceledpaiement->montant}} ar
     </div>
   <div class="product-info">
     {{$canceledpaiement->user->name}}
     <span class="product-description">
       {{$canceledpaiement->created_at}}
     </span>
   </div>
 </li>
@empty
<li class="item">
   pas d'annulation
   <li>
@endforelse


</ul>
</div>
<!-- /.card-body -->
<div class="card-footer text-center">
</div>
<!-- /.card-footer -->
</div>
<!-- /.card -->
</div>


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer row text-muted">
                        <a  target="_blank" href="{{ route('reservations.print',$reservation->id) }}"
                        class="btn m-2 btn-info">Print</a>

                             @if ($unpaid>0 && $reservation->canceled===0 && !$isadmin)
                             <a  href="{{ route('reservations.editPaid',$reservation->id) }}" class="btn m-2 btn-success">Payer</a>
                             @endif
                             @if ($reservation->canceled===0 && $travel->date>=date("Y-m-d") && !$isadmin)
                             <form action="{{ route('reservations.canceled',$reservation->id) }}" method="POST">
                             @csrf
                             @method('PUT')

                             <button type="submit" class="btn btn-danger m-2">Annuler</button>

                            </form>
                            @endif

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
