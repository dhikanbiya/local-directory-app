@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<h1>{{$show->name}} <span class="pull-right"><a href="{{route('restaurant.index')}}" class="btn btn-info btn-xs">back</a></span></h1>
</div>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-6">
			<img src="{{storage_path().'/app/public/'.$show->image}}" class="img-responsive" id="featured">	
		</div>
		<div class="col-md-6">
		<h4>Details</h5>
			<dl>
			  <dt>Name</dt>
			  <dd>{{$show->name}}</dd>
			  <dt>Address</dt>
			  <dd>{{$show->address}}</dd>
			  <dt>Phone</dt>
			  <dd>{{$show->phone}}</dd>
			  <dt>Latitude</dt>
			  <dd>{{$show->lat}}</dd>
			  <dt>Longitude</dt>
			  <dd>{{$show->lng}}</dd>
			  <dt>Promotion</dt>
			  <dd>{{$show->promotion}}</dd>
			</dl>
		</div>	
	</div>	
</div>
<div class="col-md-12 space">
	<p class="text-center"><a href="{{route('restaurant.edit',$show->id)}}" class="btn btn-md btn-success">edit</a></p>
</div>


@endsection