@extends('layouts.app')
@section('content')
<h1>Create new gas station</h1>
<form method="POST" action="{{route('fuel.store')}}" enctype="multipart/form-data">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
		<div class="row">
			<div class="form-group">
			  <label>Gas station name</label>
			  <input type="text" class="form-control" id="name" name="name" placeholder="gas station name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
			  <label>Address</label>
			  <textarea class="form-control" rows="3" name="address">
			  	{{ old('address') }}
			  </textarea>
			</div>
			<label>Gas Type</label>
			<div class="form-group">			  
			  <label class="checkbox-inline">
			    <input type="checkbox" name="gas[]" value="premium"  {!! (is_array(old('gas')) && in_array('premium',old('gas'))) ? 'checked="checked"' : '' !!}> premium
			  </label>
			  <label class="checkbox-inline">
			    <input type="checkbox" name="gas[]" value="pertalite" {!! (is_array(old('gas')) && in_array('pertalite',old('gas'))) ? 'checked="checked"' : '' !!}> pertalite
			  </label>
			  <label class="checkbox-inline">
			    <input type="checkbox" name="gas[]" value="pertamax" {!! (is_array(old('gas')) && in_array('pertamax',old('gas'))) ? 'checked="checked"' : '' !!}> pertamax
			  </label>
			  <label class="checkbox-inline">
			    <input type="checkbox" name="gas[]" value="dex" {!! (is_array(old('gas')) && in_array('dex',old('gas'))) ? 'checked="checked"' : '' !!}>dex
			  </label>
			  <label class="checkbox-inline">
			    <input type="checkbox" name="gas[]" value="dex lite" {!! (is_array(old('gas')) && in_array('dex lite',old('gas'))) ? 'checked="checked"' : '' !!}> dex lite
			  </label>
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
	<div class="form-group">
	  <label>Image</label>
	  <input type="file" id="image" name="picture" value="{{ old('image') }}">
	  <p class="help-block">only png, jpg allowed</p>
	</div>				
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('fuel.index')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
