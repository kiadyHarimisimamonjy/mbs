@extends('layouts.theme')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Guichet</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('counters.index') }}"> Retour</a>
            </div>
        </div>
    </div>


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


    <form action="{{ route('counters.update',$counter->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Ville:</strong>
		            <input type="text" name="city" value="{{ $counter->city }}" class="form-control" placeholder="Name">
		        </div>
		    </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nom:</strong>
                        <input type="text" name="name" value="{{ $counter->name }}" class="form-control" placeholder="Name">
                    </div>
                </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection
