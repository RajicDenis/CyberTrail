@extends('CyberTrail::admin_app')

@section('content')
	
	<div class="featured-box">
		@if(count($tables) != 0)

			@for($i=0; $i < count($tables); $i++)
						
				<div class="fb" style="background-image: url('{{ URL::asset('CyberTrail/images/bg/red.jpg') }}')">
				
				<div class="fb-title zi20">{{ ucfirst($tables[$i]) }}</div>

				<div class="fb-count">{{ Helper::getTableCount($tables[$i]) }}</div>

				<a href="{{ route('admin_showTable', ['slug' => $tables[$i]]) }}" class="negative ui button huge zi20">VIEW</a>

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