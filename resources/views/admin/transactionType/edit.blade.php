@extends('admin-layouts.modal-content',['form_id' => 'edit_form', 'slug'=>  $transactionType->slug ])

@section('modal-header')
	{{$transactionType->slug}} | <span class="label label-primary">EDIT</span>
@endsection

@section('modal-body')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Transaction Type
			</div>
			<div class="panel-body">
				<div class="row">
					{!! __form::a_textbox( 4,'Slug','slug', 'text', 'Slug',$transactionType->slug, 'readonly')!!}
					{!! __form::a_textbox( 8,'Name','name', 'text', 'Name',$transactionType->name, '')!!}
					{!! __form::a_textbox( 6,'Group','group', 'text', 'Group',$transactionType->transaction_types_group_slug, '')!!}
					{!! __form::a_textbox( 6,'Unit','unit', 'text', 'Unit',$transactionType->unit, '')!!}
					{!! __form::a_textbox( 4,'Fee Per Unit','feePerUnit', 'double', 'Fee Per Unit',$transactionType->fee_per_unit, '')!!}
					{!! __form::a_textbox( 4,'Regular Fee','regularFee', 'double', 'Regular Fee',$transactionType->regular_fee, '')!!}
					{!! __form::a_textbox( 4,'Expedite Fee','expediteFee', 'double', 'Expedite Fee',$transactionType->expedite_fee, '')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal-footer')
<button type="submit" class="btn btn-primary">
	<i class="fa fa-check"></i> Save
</button>
@endsection