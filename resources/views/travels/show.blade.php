@extends('layouts.theme')


@section('content')
<section class="content-header">
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
    <div class="row mx-auto">
        <div class="col-sm-6">
            <div class="col-12 text-center fs-6">
                <b> N: </b>{{$travel->id}}
            </div>
            <div class="col-12 text-center fs-6">
                <b> Itineraire: </b>{{$travel->itinerary->name}}
            </div>
            <div class="col-12 text-center fs-6">
                <b> Enregistre par: </b>{{$travel->user->name}}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-12 text-center fs-6">
                <b> depart: </b>{{   date('d-m-Y', strtotime($travel->date))}} {{$travel->hour}}
            </div>
            <div class="col-12 text-center fs-6">
                <b> Bateau: </b>{{$travel->boat->name}}
            </div>
            <div class="col-12 text-center fs-6">
                <b> Paiement: </b>{{$travel->reservationispaid()}}
            </div>
          </div><!-- /.col -->
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

        <table class="table table-bordered">
            <thead>
                <th>Nom</th>
                <th>CIN</th>
                <th width="170px">Etat</th>
            </thead>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->cin }}</td>
                <td>
                   @if ( $customer->reservation->ispaid ===0)
                         <a  href="{{ route('reservations.editPaid',$customer->reservation->id) }}" class="btn m-2 btn-success">Payer</a>

                   @endif
                <a class="btn btn-primary" href="{{ route('reservations.show',$customer->reservation->id) }}">
                voir
                                        </a>
                </td>
            </tr>
            @endforeach

        </table>

        {!! $customers->links('pagination::bootstrap-4') !!}
          </div>
          <div class="card-footer row text-muted">
            <a  target="_blank" href="{{ route('travels.manifest',$travel->id) }}"
            class="btn m-2 btn-info">Manifest</a>


                 @if ($travel->canceled===0 && $travel->date>=date("Y-m-d") && !$isadmin)
                 <form action="{{ route('travels.canceled',$travel->id) }}" method="POST">
                 @csrf
                 @method('PUT')

                 <button type="submit" class="btn btn-danger m-2">Annuler</button>

                </form>
                @endif

        </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- /.content -->

@endsection
