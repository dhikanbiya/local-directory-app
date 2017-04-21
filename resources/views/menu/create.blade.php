@extends('layouts.app')
@section('content')
<h1>Create new menu</h1>
<form method="POST" action="{{route('menu.store')}}" enctype="multipart/form-data">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
		<div class="row">
			<div class="form-group">
			  <label>Name</label>
			  <input type="text" class="form-control" id="name" name="name" placeholder="menu name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
			  <label>Price</label>
			  <input type="text" class="form-control" id="lng" name="price" placeholder="price" value="{{ old('price') }}">
			  <p class="help-block">ex: 5000</p>
			</div>									
		</div>	  	  
</div>
<input type='hidden' name='resto_id' value='{{$id}}'>
<div class="col-md-6 col-md-offset-2">
	<div class="form-group">
	  <label>Image</label>
	  <input type="file" id="image" name="picture" value="{{ old('picture') }}">
	  <p class="help-block">only png, jpg allowed</p>
	</div>			
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('restaurant.index')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
