@extends('admin-layouts.modal-content',['form_id'=> 'edit_menu_form', 'slug'=>$menu->slug])

@section('modal-header')
	{{$menu->menu_name}} | <span class="label label-primary">EDIT</span>
@endsection

@section('modal-body')
	<div class="row">
		{!! __form::a_textbox( 12,'Menu Name','menu_name', 'text', 'Name in the sidebar',$menu->menu_name, '')!!}
		{!! __form::a_textbox( 12,'Route','menu_route', 'text', 'Laravel Route',$menu->route, '')!!}
		{!! __form::a_textbox( 12,'Icon','menu_icon', 'text', 'Icon',$menu->icon, '')!!}
		{!! __form::a_textbox( 12,'Label','menu_label', 'text', 'Sidebar group',$menu->label, '')!!}
		{!! __form::a_select(6, 'Is nav', 'menu_is_nav', ['Yes' => 1, 'No' => 0], $menu->is_nav, '') !!}
		{!! __form::a_select(6, 'Is dropdown', 'menu_is_dropdown', ['Yes' => 1, 'No' => 0], $menu->is_dropdown, '') !!}
	</div>
@endsection


@section('modal-footer')
	<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection
