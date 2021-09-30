@extends('layouts.theme')


@section('content')
   <!-- Main content -->
      <!-- Content Header (Page header) -->
      <section class="content-header">
    </section>
   <section class="content">
    <div class="container-fluid">
    @if ($isadmin && $depense->etat==='en attente')

      <div class="row">
        <div class="col-12  col-sm-10 col-md-8 mx-auto">
          <!-- Default box -->
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
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title">Formulaire</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>


            <div class="card-body">


            <form action="{{ route('depenses.action',$depense->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12 x">
                    <label for="Demandeur" class="form-label"> Demandeur</label>
                 <input type="text" id="Demandeur" readonly value="{{$depense->user->name}}"
                    class="form-control">
                  </div>
                  <div class="col-12 x">
                    <label for="Caisse" class="form-label"> Caisse</label>
                 <input type="text" id="Caisse" readonly value="{{$depense->counter->name}}"
                    class="form-control">
                  </div>
                <div class="col-12 x">
                    <label for="ask" class="form-label">Montant Demande</label>
                 <input type="number" id="ask" readonly  name="ask"  value="{{$depense->montant}}"
                    class="form-control">
                  </div>

                <div class="col-12">
                    <!-- textarea -->
                    <div class="form-group mt-3">
                      <label>Objet du Demande</label>
                      <textarea class="form-control" readonly rows="3" >{{$depense->commentaire}}</textarea>
                    </div>
                  </div>
                  <div class="col-12 x">
                    <label for="montant" class="form-label">Montant</label>
                 <input type="number" id="montant" name="montant" value="{{$depense->montant}}"
                    class="form-control">
                  </div>
                <div class="col-12">
                  <!-- textarea -->
                  <div class="form-group mt-3">
                    <label>Reponse</label>
                    <textarea class="form-control" name="commentaire" rows="3" ></textarea>
                  </div>
                </div>
                <div class="col justify-content-right ">

                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">


              <input type="submit" name="action" class=" btn btn-primary " value="Approuver">
              <input type="submit" name="action" class=" btn btn-danger " value="Recaler">

            </div>
        </form>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    @else
    <div class="row mx-auto">
        <div class="col-12 fw-bold text-center fs-1 ">
            <h3><b>{{$depense->etat}} </b></h3>
            <div class="col-12 text-center fs-6">
                <h4><b>{{$depense->counter->name}}</b><h4>
            </div>
          </div><!-- /.col -->
    </div>
          <table class="table">

            <tbody>
              <tr>
                <td class="h5 col-md-2"><b>Demandeur</b></td>
                <td class="h5 col-sm-1"><b>:</b></td>
              <td class="h5 " >{{$depense->user->name}}</td>
                @if ($depense->etat!=='en attente')
                <td class="h5 col-sm-1"><b></b></td>
                <td class="h5 col-md-2"><b>Decideur</b></td>
                <td class="h5 col-sm-1"><b>:</b></td>
                <td class="h5 " >{{$depense->actiondepense->user->name}}</td>
                @endif

              </tr>
              <tr>
                <td class="h5 col-md-2"><b>Somme Demandee</b></td>
                <td class="h5 col-sm-1"><b>:</b></td>
              <td class="h5 " >{{$depense->montant}}</td>
                @if ($depense->etat!=='en attente')
                <td class="h5 col-sm-1"><b></b></td>
                <td class="h5 col-md-2"><b>Somme Approuvee</b></td>
                <td class="h5 col-sm-1"><b>:</b></td>
                <td class="h5 " >{{$depense->actiondepense->montant}}</td>
                @endif

              </tr>
              <tr>
                <td class="h5 col-md-2"><b>Commentaire</b></td>
                <td class="h5 col-sm-1"><b>:</b></td>
              <td class="h5 " >{{$depense->commentaire}}</td>
                @if ($depense->etat!=='en attente')
                <td class="h5 col-sm-1"><b></b></td>
                <td class="h5 col-md-2"><b>Reponse</b></td>
                <td class="h5 col-sm-1"><b>:</b></td>
                <td class="h5 " >{{$depense->actiondepense->commentaire}}</td>
                @endif

              </tr>




            </tbody>
          </table>





    @endif
</div>
  </section>


@endsection
