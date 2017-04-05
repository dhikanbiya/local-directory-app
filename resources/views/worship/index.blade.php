@extends('layouts.app')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1><i class="fa fa-podcast"></i> Worship Place List
<span class="pull-right"><a class="btn btn-success btn-sm" href="{{route('worship.create')}}">Add Records <i class="fa fa-plus-circle"></i></a></span>
</h1>

<table class="table table-striped">
<thead>
	<tr>
		<td>No</td>
		<td>Name</td>		
		<td>Religion</td>		
		<td>Action</td>
	</tr>
</thead>
<tbody>
@foreach($worship as $row)
<tr>		
	<td>{{ ++$i }}</td>
	<td>{{$row->name}}</td>
	<td>{{$row->religion_type}}</td>
	<td>
		<a href="{{route('worship.show',$row->id)}}" class="btn btn-xs btn-info">show <i class="fa fa-eye"></i></a>
		<a href="{{route('worship.edit',$row->id)}}" class="btn btn-xs btn-warning">edit <i class="fa fa-edit"></i></a>
		<form method="POST" action="{{route('site.destroy',$row->id)}}" style="display: inline;">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}	
			<button type="submit" name="submit" class="btn btn-danger btn-xs">delete <i class="fa fa-trash"></i></button>
		</form>		
	</td>
</tr>
@endforeach	
</tbody>
</table>
{{ $worship->links() }}
@endsection