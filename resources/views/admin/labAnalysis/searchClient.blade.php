@extends('admin-layouts.modal-content',['form_id' => 'searchClientForm'])

@section('modal-header')
	{!! __form::a_textbox( 4,'','searchClient', 'text', 'Search','', '')!!}
@endsection

@section('modal-body')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			</div>
			<div class="panel-body">
				<div class="row">
					<table id="tbClient" class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Business Name</th>
							</tr>
						</thead>
						<tbody>
						@foreach($user as $key => $slug)
							<tr id="{{$slug->slug}}">
								<td>{{$slug->slug}}</td>
								<td>{{$slug->last_name}}</td>
								<td>{{$slug->first_name}}</td>
								<td>{{$slug->middle_name}}</td>
								<td>{{$slug->business_name}}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal-footer')
@endsection