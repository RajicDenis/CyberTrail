@extends('CyberTrail::admin_app')

@section('content')

	<div class="st-head">

		<div class="st-icon"><i class="code branch huge icon"></i></div>

		<div class="st-name">Settings</div>

	</div>

	@if(Session::has('status'))
		<div class="center">
			<div class="alert {{ Session::get('alert_type') }} fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('status') }}
			</div>
		</div>
	@endif

	<div class="settings-wrap mt-5">

		<div class="af-title">Choose tables to import from your database</div>
		
		<div class="settings-box d-flex">
			<form class="w50" action="{{ route('admin_addSettings') }}" method="POST">
				{{ csrf_field() }}
				
				@foreach($jsonTables as $tbl)
					<div class="form-group fixed-width">
			            
						<input type="checkbox" name="table[]" id="checkbox_{{ $tbl }}" value="{{ $tbl }}" @if(in_array($tbl, $tables)) checked @endif autocomplete="off" />

		            	<div class="btn-group">
		                	<label for="checkbox_{{ $tbl }}" class="btn btn-default btn-lbl">
		                   		<span class="glyphicon glyphicon-ok"></span>
		                    	<span> </span>
		                	</label>
		                	<label for="checkbox_{{ $tbl }}" class="btn btn-default btn-lbl-2 active">
		                    	{{ $tbl }}
		                	</label>
		            	</div>

			        </div>
		        @endforeach

		        <button type="submit" class="ui green basic button massive mt-3"><strong>Save</strong></button>

			</form>

			<div class="d-flex justify-content-center align-items-center flex-column mb-5 w50">
				<div class="excl-box text-center">
					<i class="exclamation icon huge grey"></i>
				</div>

				<div class="excl-txt mt-5 fs18">Importing pivot tables is unnecessary since relationships are added automatically for every table</div>
			</div>

		</div>

	</div>

@stop

@section('js')

	<script>
		$(document).ready(function() {

			// Find already checked tables and add coloring for checkbox on page load
			$('.fixed-width').each(function(checkbox) {
				$checkbox = $(this).find('input[type="checkbox"]');
				if($checkbox.is(':checked')) {
					$parent = $checkbox.parents('.fixed-width');
					$parent.find('.btn-lbl-2').addClass('check');
				}
			});		

			// On click, add coloring to checkbox
			$('.btn-group').on('click', function() {
				if($(this).find('.btn-lbl-2').hasClass('check')) {
					$(this).find('.btn-lbl-2').removeClass('check');
				} else {
					$(this).find('.btn-lbl-2').addClass('check');
				}
			});
		});
	</script>

@stop