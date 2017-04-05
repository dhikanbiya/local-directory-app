@extends('layouts.app')
@section('content')
<h1>Create new public attraction</h1>
<form method="POST" action="{{route('site.store')}}" enctype="multipart/form-data">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
		<div class="row">
			<div class="form-group">
			  <label>Name</label>
			  <input type="text" class="form-control" id="name" name="name" placeholder="office name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
			  <label>Operational hour</label>
			  <input type="text"  class="form-control" name="operational" value="{{old('operational')}}" placeholder="operational hour">
			  <p class="help-block">ex: 12:00 - 21:30 </p>
			</div>			
			<div class="form-group">
			  <label>Latitude</label>
			  <input type="text" class="form-control" id="lat" name="lat" placeholder="latitude" value="{{ old('lat') }}"><p class="help-block">ex: -6.2668682</p>
			</div>
			<div class="form-group">
			  <label>Longitude</label>
			  <input type="text" class="form-control" id="lng" name="lng" placeholder="longitude" value="{{ old('lng') }}">
			  <p class="help-block">ex: 106.6620668d</p>
			</div>									
		</div>	  	  
</div>
<div class="col-md-6 col-md-offset-2">
	<div class="form-group">
	  <label>Image</label>
	  <input type="file" id="image" name="picture" value="{{ old('image') }}">
	  <p class="help-block">only png, jpg allowed</p>
	</div>			
	<div class="form-group">
	  <label>Facility</label>
	  <textarea class="form-control" rows="5" name="facility">{{ old('facility') }}</textarea>
	</div>
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('office.index')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
