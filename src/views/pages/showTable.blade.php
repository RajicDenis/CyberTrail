@extends('CyberTrail::admin_app')

@section('content')

	<div class="st-head justify-content-between">

		<div class="st-box d-flex">
			<div class="st-icon">
				<img src="{{ asset('CyberTrail/images/leaf-icon.png') }}">
			</div>

			<div class="st-name">{{ ucfirst($selectedTable) }}</div>
		</div>

		<a href="{{ route('admin_addToTable', ['slug' => $selectedTable]) }}" class="ui basic blue button huge">Add New</a>

	</div>

	@if(Session::has('status'))
		<div class="center">
			<div class="alert {{ Session::get('alert_type') }} fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('status') }}
			</div>
		</div>
	@endif

	<div id="table-wrap">

	@if(count($tableData) != 0)		
		<table id="admin_table" class="table">
			<thead>
				<tr class="tbl-head" style="height: 50px; background: #EEF0F2;">

					@foreach($tableName as $t)
						<th>{{ strtoupper($t) }}</th>
					@endforeach
						@if(isset($tableData[0]->id))
						<th></th>
						@endif

				</tr>
			</thead>

			
			<tbody>
				@foreach($tableData as $t)
					<tr>
						@foreach($tableName as $tbl)
							@if($tbl != 'image')
								@if($tbl == 'id')
									<td width="50">{{ $t->$tbl }}</td>
								@else
									<td>{{ substr($t->$tbl, 0, 350) }}</td>
								@endif			
							@else
								<td><img style="width: 80px; height: 80px;" src="{{ asset($t->$tbl) }}"></td>
							@endif
						@endforeach
							@if(isset($t->id))
							<td style="text-align: right; width: 120px;">
								<a href="{{ route('admin_addToTable', ['slug' => $selectedTable, 'pid' => $t->id]) }}" class="ui yellow basic button big"><i class="fas fa-pencil-alt"></i></a>
								<form action="{{ route('admin_delete', $t->id) }}" method="POST" id="delete_form_{{ $t->id }}" style="display: none;">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="tableName" value="{{ $selectedTable }}">
								</form>
								<div class="ui red basic button big del" data-id='delete_form_{{ $t->id }}'><i class="fas fa-trash"></i></div>
							</td>
							@endif
					</tr>

				@endforeach
			</tbody>		
			
		</table>
	@else
		<div class="d-flex justify-content-center mb-5">
			<div class="excl-box text-center">
				<i class="exclamation icon huge grey"></i>
			</div>
		</div>

		<div class="excl-txt">Table is empty!!</div>
	@endif

	</div>

@stop

@section('js')

	<script>
		
		$(document).ready(function() {		

			if($('.empty-info').length == 0) {
				$('#admin_table').dataTable({
					language: { search: "" },
				});

				// Edit datatables css 
				$('#admin_table_wrapper > .row').each(function($index) {

					if($index == 0) {
						$(this).css({
							'margin-bottom': '40px',
							'width': '100%'
						});
					} 

					if($index == 1) {
						$(this).css('width', '100%');
					} 

					if($index == 2) {
						$(this).css({
							'margin-top': '50px',
							'width': '100%',
							'display': 'flex',
							'justify-content': 'center'
						});
					}

				});

				$('input[type="search"]').attr('placeholder', 'Search');
			}

		});

	</script>

@stop