@extends('layouts.theme')


@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listes des Depenses</h1>
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
                                <form action="{{ route('depenses.index') }}" method="GET">
                                     <b> <button class="btn btn-info" type="submit"><i class="fa fa-search fa-fw"></i> Recherche</button> </b>

                                        <select class="form-control col col-md-2 mx-2" name="etat" >
                                            <option value="all">tous</option>
                                            <option >en attente</option>
                                            <option >approuvee</option>
                                            <option >approuvee et modifiee</option>
                                            <option >refusee</option>
                                        </select>

                                        @if ($isadmin)
                                        <input type="text"  name="nom" placeholder="nom" class="form-control col col-md-2 mx-2" >

                                        @endif


                                          <input type="date"  name="debut" placeholder="debut" class="form-control col col-md-2 mx-2" >
                                            <input type="date"   placeholder="fin" name="fin" class="form-control col col-md-2 mx-2" >



                                </form>
                            </div>
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
                                @foreach ($depenses as $depense)
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
    {!! $depenses->links('pagination::bootstrap-4') !!}
</section>
<!-- /.content -->





@endsection
