@extends('layouts.app')
@section('content')
<h1>Edit menu</h1>
<form method="POST" action="{{route('menu.update',$row->id)}}" enctype="multipart/form-data">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
	{{ method_field('PATCH') }} 
		<div class="row">
			<div class="form-group">
			  <label>Office name</label>
			  <input type="text" class="form-control" id="name" name="name" placeholder="office name" value="{{ $row->name }}">
			</div>			
			<div class="form-group">
			  <label>Price</label>
			  <input type="text" class="form-control" id="price" name="price" placeholder="price" value="{{ $row->price }}">
			</div>
			<div class="form-group">
			  <label>Image</label>
			  <input type="file" id="image" name="picture" value="{{ old('image') }}">
			  <p class="help-block">only png, jpg allowed</p>
			</div>
			<input type="hidden" name="resto" value="{{$row->restaurant_id}}">
		</div>	  	  
</div>
<div class="col-md-6 col-md-offset-2">	
	<div class="form-group">
	  <label>Image Preview</label>
	  <img src="{{asset('storage/'.$row->image)}}" class="img-responsive img-preview">
	  <input type="hidden" name="oldpic" value="{{$row->image}}">
	</div>							
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('restaurant.index')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
