@extends('layouts.app')
@section('content')
<h1>Edit Worship Place</h1>
<form method="POST" action="{{route('worship.update',$row->id)}}" enctype="multipart/form-data">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
	{{ method_field('PATCH') }} 
		<div class="row">
			<div class="form-group">
			  <label>Name</label>
			  <input type="text" class="form-control" id="name" name="name" placeholder="worship place name" value="{{ $row->name }}">
			</div>
			<div class="form-group">
			  <label>Address</label>
			  <textarea class="form-control" rows="5" name="address">{{$row->address}}</textarea>
			</div>						
			<div class="form-group">
			  <label>Latitude</label>
			  <input type="text" class="form-control" id="lat" name="lat" placeholder="latitude" value="{{ $row->lat }}"><p class="help-block">ex: -6.2668682</p>
			</div>
			<div class="form-group">
			  <label>Longitude</label>
			  <input type="text" class="form-control" id="lng" name="lng" placeholder="longitude" value="{{ $row->lng }}">
			  <p class="help-block">ex: 106.6620668d</p>
			</div>									
		</div>	  	  
</div>
<div class="col-md-6 col-md-offset-2">
	<label>Religion </label>
	<div class="form-group">			  
	  <label class="radio-inline">
	    <input type="radio" name="rel" value="muslim" @if($row->religion_type == 'muslim') checked="checked" @endif > Muslim
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="catholic" @if($row->religion_type == 'catholic') checked="checked" @endif  > Catholic
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="christian" @if($row->religion_type == 'christian') checked="checked" @endif> Christian
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="bhuddis" @if($row->religion_type == 'buddhis') checked="checked" @endif> Buddhis
	  </label>
	  <label class="radio-inline">
	    <input type="radio" name="rel"  value="confucion" @if($row->religion_type == 'confucion') checked="checked" @endif> Confucion
	  </label>
	</div>
	<div class="form-group">
	  <label>Image Preview</label>
	  <img src="{{asset('storage/$row->image')}}" class="img-responsive img-preview">
	  <input type="hidden" name="oldpic" value="{{$row->image}}">
	</div>			
	<div class="form-group">
	  <label>Image</label>
	  <input type="file" id="image" name="picture" value="{{ old('image') }}">
	  <p class="help-block">only png, jpg allowed</p>
	</div>				
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('worship.index')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
