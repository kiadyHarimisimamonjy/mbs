@extends('layouts.theme')


@section('content')
   <!-- Main content -->
      <!-- Content Header (Page header) -->
      <section class="content-header">
    </section>
   <section class="content">
    <div class="container-fluid">

    <div class="row mx-auto">
        <div class="col-12 fw-bold text-center fs-1 ">
            <h3><b>
                 @if( $checkoutopen->isclosed===1)
                        Fermee
                @else
                Ouvert
                @endif
 </b></h3>
            <div class="col-12 text-center fs-6">
                <h4><b>{{$checkoutopen->counter->name}}</b><h4>
            </div>
          </div><!-- /.col -->
    </div>
          <table class="table">

            <tbody>
              <tr>
                <td class="h5 col-md-2"><b>Creer par</b></td>

              <td class="h5 " >{{$checkoutopen->user->name}}</td>
                @if ($checkoutopen->isclosed===1)
                <td class="h5 col-md-2"><b>Fermee par </b></td>

                <td class="h5 " >{{$checkoutopen->checkoutclose->user->name}}</td>
                @endif

              </tr>
               <tr>
                <td class="h5 col-md-2"><b>Creee le</b></td>

              <td class="h5 col-md-3" >{{$checkoutopen->created_at}}</td>
                @if ($checkoutopen->isclosed===1)
                <td class="h5 col-md-2"><b>Fermee le </b></td>

                <td class="h5 " >{{$checkoutopen->checkoutclose->created_at}}</td>
                @endif

              </tr>
              <tr>
                <td class="h5 col-md-2"><b>Somme </b></td>

              <td class="h5 " >{{$checkoutopen->montant}}</td>
                @if ($checkoutopen->isclosed===1)
                <td class="h5 col-md-2"><b>Somme </b></td>

                <td class="h5 " >{{$checkoutopen->checkoutclose->constate}}</td>
                @endif

              </tr>
                  <tr>
                <td class="h5 col-md-2"><b>Reference</b></td>

              <td class="h5 " >{{$checkoutopen->derniermontant}}</td>
                @if ($checkoutopen->isclosed===1)
   <td class="h5 col-md-2"><b>Reference</b></td>
                <td class="h5 " >{{$checkoutopen->checkoutclose->calcule}}</td>
                @endif

              </tr>
               <tr>
                <td class="h5 col-md-2"><b>Decalage</b></td>

              <td class="h5 " >{{$checkoutopen->montant-$checkoutopen->derniermontant}}</td>
                @if ($checkoutopen->isclosed===1)
                <td class="h5 col-md-2"><b>Decalage</b></td>

                <td class="h5 " >{{$checkoutopen->checkoutclose->decalage}}</td>
                @endif

              </tr>
              <tr>
                <td class="h5 col-md-2"><b>Remarque </b></td>

              <td class="h5 " >{{$checkoutopen->commentaire}}</td>
                @if ($checkoutopen->isclosed===1)
                <td class="h5 col-md-2"><b>Remarque </b></td>

                <td class="h5 " >{{$checkoutopen->checkoutclose->commentaire}}</td>
                @endif
              </tr>
  @if ($checkoutopen->isclosed===1)
   <tr>
                <td class="h5 col-md-2"><b></b></td>
                <td class="h5 col-sm-1"><b></b></td>

                <td class="h5 col-md-2"><b>Reservation</b></td>

                <td class="h5 " >
                        <a class="btn btn-secondary" href="{{ route('checkouts.check',['id'=>$checkoutopen->id,'by'=>'paie']) }}" >
                            {{$checkoutopen->checkoutclose->paie}}</a></td>
              </tr>
               <tr>
                <td class="h5 col-md-2"><b></b></td>
                <td class="h5 col-sm-1"><b></b></td>

                <td class="h5 col-md-2"><b>Annulation </b></td>

                <td class="h5 " >
                        <a class="btn btn-secondary" href="{{ route('checkouts.check',['id'=>$checkoutopen->id,'by'=>'annulation']) }}" >
                            {{$checkoutopen->checkoutclose->annulation}}</a></td>
              </tr>
               <tr>
                <td class="h5 col-md-2"><b></b></td>
                <td class="h5 col-sm-1"><b></b></td>

                <td class="h5 col-md-2"><b>Depense</b></td>

                <td class="h5 " >
                        <a class="btn btn-secondary" href="{{ route('checkouts.check',['id'=>$checkoutopen->id,'by'=>'depense']) }}" >
                        {{$checkoutopen->checkoutclose->depense}}</a></td>
              </tr>

 @endif

            </tbody>
          </table>




<div class="row mt-3  justify-content-center">
    <a class="btn btn-secondary" href="{{ route('home') }}" > Retour</a>
@if ($checkoutopen->isclosed===0)
    <a class="btn btn-danger" href="{{ route('checkoutcloses.closeform',$checkoutopen->id) }}" > Fermer</a>
    @endif
  </div>



</div>
  </section>


@endsection
