@extends('CyberTrail::admin_app')

@section('content')
	
	<div class="featured-box">
		@if(count($tables) != 0)

			@for($i=0; $i < count($tables); $i++)
			
			@if($i == 0)
			<div class="fb" style="background-image: url('{{ URL::asset('CyberTrail/images/bg/users.jpg') }}')">
				
				<div class="fb-circle zi20"><i class="fas fa-users fa-3x"></i></div>

			@elseif($i == 1)

			<div class="fb" style="background-image: url('{{ URL::asset('CyberTrail/images/bg/office.jpg') }}')">
				
				<div class="fb-circle zi20"><i class="fas fa-book fa-3x"></i></div>

			@elseif($i == 2)

			<div class="fb" style="background-image: url('{{ URL::asset('CyberTrail/images/bg/office2.jpg') }}')">
				
				<div class="fb-circle zi20"><i class="fas fa-briefcase fa-3x"></i></div>

			@endif

				<div class="fb-title zi20">{{ ucfirst($tables[$i]) }}</div>

				<div class="fb-desc zi20">You have {{ Helper::getTableCount($tables[$i]).' '.$tables[$i] }}  in your database. Click "View" to see all {{ $tables[$i] }}.</div>

				<a href="{{ route('admin_showTable', ['slug' => $tables[$i]]) }}" class="green_btn zi20">VIEW</a>

			</div>
	
			@if($i == 2) @break @endif

			@endfor

		@else
			
			<div class="d-flex justify-content-center align-items-center flex-column mb-5 w50">
				<div class="excl-box text-center">
					<i class="exclamation icon huge grey"></i>
				</div>

				<div class="excl-txt mt-5 fs18">You have not selected any tables from the database yet. To select tables just go to "Settings" and choose the tables you wish to import from the database!</div>
			</div>

		@endif

	<!-- END featured-box -->
	</div>
		
@stop