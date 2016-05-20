@extends('layouts.app')

@section('content')
	
	<h1>{{ $event->title }}</h1>
	@foreach ($event->charities as $charity)
		<h4> {{ $charity->title }} </h4>

		<p> {{ $charity->body }} </p>
		
		<p><a href="/charities/{{ $charity->id }}/edit" >Edit</a></p>
		<p><a href="/charities/{{ $charity->id }}/delete" >Delete</a></p>

	@endforeach	

	 

	<div class="row">
		<div class="col col-xs-9">
			<h3> Add a new Charity </h3>
			<form method="POST" action="/events/{{ $event->id }}/charities">
				<div class="form-group">
					{{ csrf_field() }}
					
					<input class="form-control" type="text" name="title" placeholder="Charity Name">
					<textarea class="form-control" name="body" id="" cols="30" rows="10" placeholder="Charity Description"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Charity</button>
				</div>
			</form>			
		</div>
	</div>

	
@endsection


                   