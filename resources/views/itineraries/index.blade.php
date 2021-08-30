@extends('layouts.theme')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tarifs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('itineraries.create') }}">Nouveau</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Depart</th>
            <th>Arrive</th>
            <th>Resident</th>
            <th>Etranger</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($itineraries as $itinerary)
	    <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $itinerary->name }}</td>
            <td>{{ $itinerary->leaving }}</td>
            <td>{{ $itinerary->arrival }}</td>
            <td>{{ number_format($itinerary->national ,0, '.', ' ') }}</td>
            <td>{{number_format($itinerary->foreigner,0, '.', ' ')  }}</td>
	        <td>
                <form action="{{ route('itineraries.destroy',$itinerary->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('itineraries.edit',$itinerary->id) }}">Edit</a>


                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $itineraries->links() !!}


@endsection
