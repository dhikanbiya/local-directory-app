@extends('layouts.app')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<a href="{{route('restaurant.index')}}" class="btn btn-info btn-xs">back</a></span></h1>
@foreach($records as $show)
<div class="col-md-12">
	<h1>{{$show->name}} <span class="pull-right">
</div>
<div class="col-md-12 space">
	<div class="row">
		<div class="col-md-6">
			<img src="{{asset('storage/$show->image')}}" class="img-responsive" id="featured">	
		</div>
		<div class="col-md-6">
		<h4>Details</h5>
			<dl>
			  <dt>Name</dt>
			  <dd>{{$show->name}}</dd>
			  <dt>Price</dt>
			  <dd>{{$show->price}}</dd>			  
			</dl>
			<a href="{{route('menu.edit',$show->id)}}" class="btn btn-md btn-success">edit <i class="fa fa-edit"></i></a>
			<form method="POST" action="{{route('menu.destroy',$show->id)}}" style="display: inline;">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}	
				<button type="submit" name="submit" class="btn btn-danger btn-md">delete <i class="fa fa-trash"></i></button>
			</form>		
		</div>	
	</div>	
</div>

@endforeach

@endsection