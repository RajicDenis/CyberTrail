@extends('CyberTrail::admin_app')

@section('content')
	
	<div class="st-head">

		<div class="st-icon"><i class="far fa-plus-square fa-3x"></i></div>

		<div class="st-name">{{ ucfirst($selectedTable) }} table</div>

	</div>

	@if(Session::has('success'))
		<div class="center">
			<div class="alert alert-success fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('success') }}
			</div>
		</div>
	@endif

	<div id="table-wrap">

		<div class="add-form">
			
			<div class="af-title">Add Data to {{ $selectedTable }} table</div>

			<form id="add_form" action="{{ route('admin_store') }}" method="POST" enctype="multipart/form-data">
				
				{{ csrf_field() }}

				<input type="hidden" name="tableName" value="{{ $selectedTable }}">

				@foreach($tableName as $t)

					@if($t != 'id')

						<div class="form-group row">

							<label class="col-sm-1 col-form-label" for="{{ $t }}">{{ str_replace('_', ' ', ucfirst($t)) }}</label>

							@if(in_array(Helper::getFieldType($selectedTable, $t), Helper::numericTypes()))
								<div class="col-sm-11">
									<input class="custom_input" type="number" id="{{ $t }}" name="{{ $t }}" required>
								</div>
							@elseif($t == 'email')
								<div class="col-sm-11">
									<input class="custom_input" type="email" id="{{ $t }}" name="{{ $t }}" required>
								</div>
							@elseif(Helper::getFieldType($selectedTable, $t) == 'text')
								<div class="col-sm-11">
									<textarea class="w50" id="{{ $t }}" name="{{ $t }}" rows="8"></textarea>
								</div>
							@elseif(Helper::getFieldType($selectedTable, $t) == 'date')
								<div class="col-sm-11">
									<input type="date" id="{{ $t }}" name="{{ $t }}">
								</div>
							@elseif($t == 'image' || $t == 'picture' || $t == 'img')
								<div class="col-sm-11">
									<input class="custom_input" type="text" id="{{ $t }}" name="destination" placeholder="File destination folder (has to be inside the public folder) e.g. images/products"><br>
								</div>

								<div class="col-sm-11">
									<input type="file" name="image" id="{{ $t }}">
								</div>
							@else
								<div class="col-sm-11">
									<input class="custom_input" type="text" id="{{ $t }}" name="{{ $t }}">
								</div>
							@endif
						</div>

					@endif

				@endforeach

				<button class="ui green basic button huge">Save</button>

			</form>

		</div>

	</div>

@stop

@section('js')

	<script>
		$(document).ready(function() {

			// Create breadcrumb
			$('.at-left').append('<i class="fas fa-angle-right fa-2x bread-arrow"></i><a href="{{ route('admin_showTable', ['slug' => $selectedTable]) }}" class="breadcrumb-title breadcrumb-item">{{ $selectedTable }}</a>');

		});

	</script>

@stop