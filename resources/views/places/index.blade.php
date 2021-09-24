@extends('layouts.theme')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('places.create') }}">Nouveau</a>
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
            <th>Bateau</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($places as $place)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>numero {{ $place->name }}</td>
	        <td>{{ $place->boat->name }}</td>
	        <td>
                <form action="{{ route('places.destroy',$place->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('places.edit',$place->id) }}">Edit</a>


                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $places->links('pagination::bootstrap-4') !!}


@endsection
