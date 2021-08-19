@extends('layouts.theme')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Guichet</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('itineraries.index') }}"> Retour</a>
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


    <form action="{{ route('itineraries.update',$itinerary->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nom:</strong>
		            <input type="text" name="name" value="{{ $itinerary->name }}"  class="form-control" placeholder="Denomination">
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Resident:</strong>
		            <input type="number" name="national"  value="{{ $itinerary->national }}" class="form-control" placeholder="En Ariary">
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Etranger:</strong>
		            <input type="number" name="foreigner"  value="{{ $itinerary->foreigner }}" class="form-control" placeholder="En Ariary">
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Depart:</strong>

                    <select class="form-control select2" name="leaving" style="width: 100%;">
                        @foreach ( $counters as   $counter)
                        @php
                            $selected = '';
                        if($itinerary->leaving ==  $counter->city)    // Any Id
                        {
                            $selected = 'selected="selected"';
                        }
                        @endphp
                        <option {{ $selected}} >{{ $counter->city}}</option>
                        @endforeach

                      </select>
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Arrive:</strong>
                    <select class="form-control select2" name="arrival" style="width: 100%;">
                        @foreach ( $counters as   $counter)
                        @php
                            $selected = '';
                        if($itinerary->arrival ==  $counter->city)    // Any Id
                        {
                            $selected = 'selected="selected"';
                        }
                        @endphp

                        <option {{ $selected}} >{{ $counter->city}}</option>
                        @endforeach

                      </select>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection
