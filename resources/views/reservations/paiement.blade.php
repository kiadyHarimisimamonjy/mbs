@extends('layouts.theme')


@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Payer Reservation</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('reservations.index') }}"> Retour</a>
            </div>
        </div>
    </div>

</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">


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


    <form action="{{ route('reservations.paid',$reservation ) }}" method="POST">
    	@csrf
        @method('PUT')

        <div class="row pt-3 m-0 ">
            <div class="col-4">
                <label for="Itineraire" class="form-label fs-6 fw-bolder align-text-center">
                    <img src="" alt=""> Itineraire
                </label>
                <input readonly type="text" id='Itineraire'
            class="form-control text-center border-secondary" value="{{ $itinerary->name}}">
            </div>
            <div class="col-4">
                <label for="Recu" class="form-label fs-6 fw-bolder align-text-center">
                    <img src="" alt=""> Recu
                </label>
                <input readonly type="text" id='Recu'
                    class="form-control text-center border-secondary" value="{{$sumpaid}}">

            </div>
            <div class="col-4">
                <label for="Net" class="form-label fs-6 fw-bolder align-text-center">
                    <img src="" alt=""> Net a paye
                </label>
                <input readonly type="text" id='Net'
                    class="form-control text-center border-secondary" value="{{$reservation->total}}">

            </div>

        </div>
        <div class="row pt-3 m-0 ">
            <div class="col-5">
                <label for="Client" class="form-label fs-6 fw-bolder align-text-center">
                    <img src="" alt=""> Client
                </label>
                <input readonly type="text" id='Client'
                    class="form-control text-center border-secondary" value="{{$reservation->customer}}">
            </div>

            <div class="col-5">
                <label for="Reste" class="form-label fs-6 fw-bolder align-text-center">
                    <img src="" alt=""> Reste
                </label>
                <input readonly type="text" id='Reste' name='reste'
                    class="form-control text-center border-secondary" value="{{$unpaid}}">

            </div>

        </div>
        <div class="row pt-3 m-0 ">
            <div class="col-5">
                <label for="Montant" class="form-label fs-6 fw-bolder align-text-center">
                    <img src="" alt=""> Montant:
                </label>
                <input  type="number" id='Montant' name='montant'
                    class="form-control text-center border-secondary" value="{{$unpaid}}">
            </div>


        </div>

        <div class="row mt-3  justify-content-center">
            <button type="submit" class="btn btn-danger">Submit</button>
          </div>
    </form>

</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
