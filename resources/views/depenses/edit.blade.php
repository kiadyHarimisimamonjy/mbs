@extends('layouts.theme')


@section('content')
   <!-- Main content -->
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Nouvelle Depense</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
   <section class="content">

    <div class="container-fluid">
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


            <form action="{{ route('depenses.update',$depense->id) }}" method="POST">
                @csrf
                @method('PUT')

               <div class="col-12 x">
                  <label for="montant" class="form-label">Montant</label>
               <input type="number" id="montant" name="montant" value="{{$depense->montant}}"
                  class="form-control">
                </div>
                <div class="col-12">
                  <!-- textarea -->
                  <div class="form-group mt-3">
                    <label>Description du Motif</label>
                    <textarea class="form-control" name="commentaire" rows="3" >{{$depense->commentaire}}</textarea>
                  </div>
                </div>
                <div class="col justify-content-right ">

                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                @if ( $depense->user_id===Auth::user()->id && $depense->etat==="en attente")

              <input type="submit" name="action" class=" btn btn-primary " value="Modifier">
              <input type="submit" name="action" class=" btn btn-danger " value="Supprimer">
              @endif
            </div>
        </form>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>


@endsection
