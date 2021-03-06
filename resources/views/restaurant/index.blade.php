@extends('layouts.app')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1><i class="fa fa-cutlery"></i> Restaurant List 
<span class="pull-right"><a class="btn btn-success btn-sm" href="{{route('restaurant.create')}}">Add Records <i class="fa fa-plus-circle"></i></a></span>
</h1>

<table class="table table-striped">
<thead>
	<tr>
		<td>No</td>
		<td>Name</td>
		<td>Phone</td>
		<td>Action</td>
	</tr>
</thead>
<tbody>
@foreach($resto as $row)
<tr>		
	<td>{{ (($resto->currentPage() - 1 ) * $resto->perPage() ) + $loop->iteration }}</td>
	<td>{{$row->name}}</td>
	<td>{{$row->phone}}</td>
	<td>
		<a href="{{route('restaurant.show',$row->id)}}" class="btn btn-xs btn-info">show <i class="fa fa-eye"></i></a>
		<a href="{{route ('menu.show',$row->id)}}" class="btn btn-xs btn-success">show menu <i class="fa fa-eye"></i></a>
		<a href="{{route('restaurant.edit',$row->id)}}" class="btn btn-xs btn-warning">edit <i class="fa fa-edit"></i></a>		
		<form method="POST" action="{{route('restaurant.destroy',$row->id)}}" style="display: inline;">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}	
			<button type="submit" name="submit" class="btn btn-danger btn-xs">delete <i class="fa fa-trash"></i></button>
		</form>		
	</td>
</tr>
@endforeach	
</tbody>
</table>
{{ $resto->links() }}
@endsection
