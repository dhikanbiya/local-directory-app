@extends('layouts.app')
@section('content')
<h1>Create new public attraction</h1>
<form method="POST" action="{{route('worship.store')}}" enctype="multipart/form-data">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
		<div class="row">
			<div class="form-group">
			  <label>Name</label>
			  <input type="text" class="form-control" id="name" name="name" placeholder="worship name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
			  <label>Address</label>
			  <textarea class="form-control" rows="5" name="address">{{ old('address') }}</textarea>
			</div>
			<div class="form-group">
			  <label>Latitude</label>
			  <input type="text" class="form-control" id="lat" name="lat" placeholder="latitude" value="{{ old('lat') }}"><p class="help-block">ex: -6.2668682</p>
			</div>			
		</div>	  	  
</div>
<div class="col-md-6 col-md-offset-2">
	<div class="form-group">
	  <label>Longitude</label>
	  <input type="text" class="form-control" id="lng" name="lng" placeholder="longitude" value="{{ old('lng') }}">
	  <p class="help-block">ex: 106.6620668d</p>
	</div>									
	<label>Religion </label>
	<div class="form-group">			  
	  <label class="radio-inline">
	    <input type="radio" name="rel" value="muslim"> Muslim
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="catholic"> Catholic
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="christian"> Christian
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="bhuddis"> Buddhis
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="confucion"> Confucion
	  </label>
	</div>
	<div class="form-group">
	  <label>Image</label>
	  <input type="file" id="image" name="picture" value="{{ old('image') }}">
	  <p class="help-block">only png, jpg allowed</p>
	</div>				
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('office.index')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
