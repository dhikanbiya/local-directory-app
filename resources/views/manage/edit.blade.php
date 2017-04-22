@extends('layouts.app')
@section('content')
<h1>Update Password</h1>
<form method="POST" action="{{route('updatepass')}}">
<div class="col-md-4 col-sm-12 col-xs-12">	
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
		<div class="row">
			<div class="form-group">
			  <label>New password</label>
			  <input type="password" class="form-control" id="password" name="name"  value="{{ old('password') }}">
			</div>
			<div class="form-group">
			  <label>Confirm new password</label>
			  <input type="password" class="form-control"  name="confpass"  value="{{ old('confpass') }}">		 
			</div>									
		</div>	  	  
<input type='hidden' name='id' value='{{Auth::user()->id}}'>
	  <button type="submit" class="btn btn-success">Save</button>
	  <a href="{{route('home')}}" class="btn btn-warning">back</a>	
</div>
</form>			
@endsection
