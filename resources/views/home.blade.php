@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>hello {{Auth::user()->name}}</h1>
    </div>
</div>
@endsection
