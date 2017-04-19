@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<h1>{{$show->name}} <span class="pull-right"><a href="{{route('fuel.index')}}" class="btn btn-info btn-xs">back</a></span></h1>
</div>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-6">
			<img src="{{asset('storage/$show->image')}}" class="img-responsive" id="featured">	
		</div>
		<div class="col-md-6">
		<h4>Details</h5>
			<dl>
			  <dt>Name</dt>
			  <dd>{{$show->name}}</dd>
			  <dt>Address</dt>
			  <dd>{{$show->address}}</dd>			  
			  <dt>Latitude</dt>
			  <dd>{{$show->lat}}</dd>
			  <dt>Longitude</dt>
			  <dd>{{$show->lng}}</dd>			  
			</dl>
		</div>	
	</div>	
</div>
<div class="col-md-12 space">
	<p class="text-center"><a href="{{route('fuel.edit',$show->id)}}" class="btn btn-md btn-success">edit</a></p>
</div>


@endsection	