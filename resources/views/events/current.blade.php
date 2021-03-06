@extends('layouts.app')

@section('header')
    <div class="container">
		<h1>{{ $currentEvent->title }}</h1>
		<h4 class=page-sub-title>Charity Nominees</h4>
	</div>
@endsection

@section('content')

@include ('flash')

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				@if($currentEvent->checkin()->where('checkins.user_id', $user->id)->count() < 1 )
					<div class="alert alert-danger" role="alert">
						<p class="lead text-center">Please check in to event below</p>
						<form method="POST" action="/events/{{ $currentEvent->id }}/check-in">
							<div class="form-group text-center">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-primary">Check-in</a>
							</div>
						</form>		
					</div>
				@else
					<h2 class="lead">Thank you for coming <br>this evening!</h2>
					<p class="lead text-center">Here are your nominees, once voting has begun we will display the secret word so that you can submit your vote.</p>					
				@endif	
			</div>

		</div>
		<div class="row">
			<div class="col-xs-12">
				
	@foreach ($currentEvent->charities as $charity)
	
	<div class='charity'>
		<div class="row ">
			<div class="col-xs-12 col-sm-3 charity-logo">
				@if (Auth::user()->admin == 'admin')
				<div class="admin-options">
					<p class="admin-gear"><i class="fa fa-gear"></i></p>
					<div class="admin-show">
						<p class="text-right">
							<a href="/charities/{{ $charity->id }}/delete" class="btn btn-danger pull-right"> Delete</a><a href="/charities/{{ $charity->id }}/edit" class="btn btn-warning pull-right" >Edit</a>
						</p> 
					</div>
				</div>
				@endif			
				<img src='{{ asset($charity->thumbnail) }}'>

			</div>
			<div class="col-xs-12 col-sm-9 charity-description">
				
				<h4> {{ $charity->title }} </h4>
				<h5> <a href="#">www.kickstarter.com</a></h5>
				<p > {{ $charity->body }} </p>
			</div>
			<!-- button for voting  -->
			
			<div class="col-xs-12">
				@if($currentEvent->votes()->where('votes.user_id', $user->id)->count() == 0)
					<a class="btn btn-secondary vote" type="button" href="/charities/{{ $charity->id }}/voting">Vote!</a>

							
				@endif
				@if($charity->votes()->where('votes.user_id', $user->id)->count() > 0)
					<p>Thanks {{$user->name }}!</p>	
				@endif
			</div>
		</div>
	</div>



	

		
	@endforeach	
			</div>
		</div>
	</div>




@endsection


                   