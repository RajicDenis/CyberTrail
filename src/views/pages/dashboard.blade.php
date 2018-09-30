@extends('CyberTrail::admin_app')

@section('content')
	
	<div class="featured-box">

		@for($i=0; $i < 3; $i++)
		
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

			<div class="fb-title zi20">{{ ucfirst($featured[$i]) }}</div>

			<div class="fb-desc zi20">You have {{ Helper::getTableCount($featured[$i]).' '.$featured[$i] }}  in your database. Click "View" to see all {{ $featured[$i] }}.</div>

			<a href="{{ route('admin_showTable', ['slug' => $featured[$i]]) }}" class="green_btn zi20">VIEW</a>

		</div>

		@endfor

	</div>
		
@stop