@extends('admin-layouts.modal-content',['form_id'=> 'edit_function_form', 'slug' => $function->slug])

@section('modal-header')
	{{$function->function_name}} | <span class="label label-primary">EDIT</span>
@endsection

@section('modal-body')

	<div class="row">
		{!! __form::a_textbox( 12,'Name','function_name', 'text', 'Name of Function', $function->function_name, '')!!}
		{!! __form::a_textbox( 12,'Label','function_label', 'text', 'This may show in sidebar',$function->function_label, '')!!}
		{!! __form::a_textbox( 12,'Route','function_route', 'text', 'Function route',$function->function_route, '')!!}
		{!! __form::a_textbox( 12,'Icon','function_icon', 'text', 'Function icon',$function->function_icon, '')!!}
		{!! __form::a_select(6, 'Is nav', 'function_is_nav', ['Yes' => 1, 'No' => '0'], $function->function_is_nav, '') !!}
		{!! __form::a_select(6, 'Belongs to', 'function_belongs_to', ['Admin' => 'admin', 'User' => 'user'], $function->function_belongs_to, '') !!}
	</div>

@endsection


@section('modal-footer')
	<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection