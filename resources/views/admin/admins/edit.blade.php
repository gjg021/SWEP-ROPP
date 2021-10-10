@extends('admin-layouts.modal-content',['form_id' => 'edit_admin_form', 'slug'=>  $admin->slug ])

@section('modal-header')
	{{$admin->fullname}} | <span class="label label-primary">EDIT</span>
@endsection

@section('modal-body')
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				Administrator Details
			</div>

			<div class="panel-body">
				<div class="row">
					{!! __form::a_textbox( 12,'First Name','first_name', 'text', 'First Name',$admin->first_name, '')!!}
					{!! __form::a_textbox( 12,'Middle Name','middle_name', 'text', 'Middle Name',$admin->middle_name, '')!!}

					{!! __form::a_textbox( 12,'Last Name','last_name', 'text', 'Last Name',$admin->last_name, '')!!}

					{!! __form::a_textbox( 12,'Email Address','email', 'text', 'Email Address',$admin->email, '')!!}

					{!! __form::a_textbox( 12,'Position','position', 'text', 'Position',$admin->position, '')!!}
	        		
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				Administrator Menus and Functions
			</div>
			<div class="panel-body">
				<div class="row">
					@if($menus->get()->count() > 0)
						@foreach($menus->get() as $menu)
							<div class="col-md-3">
								<div class="panel panel-default">
				                    <div class="panel-heading">
				                      <i class="{{$menu->icon}}"></i>
				                      {{$menu->menu_name}}
				                      <div class="pull-right">
				                        <button class="btn btn-xs btn-default clear_btn" type="button" menu="{{$menu->slug}}">Clear</button>
				                      </div>
				                    </div>
				                    <div class="panel-body" style="min-height: 180px">
				                    	@if($menu->functions->count() > 0)
				                    		@php
				                    		$total = $menu->functions->count();
				                    		$selected = 0;
				                    		@endphp
					                      	<div class="row">
					                        	<div class="col-sm-12">
					                        		<select multiple="" name="menus[{{$menu->slug}}][]" class="form-control select_multiple" size="6"menu="{{$menu->slug}}">
					                        			@foreach($menu->functions as $function)       
					                        				@if($function->function_belongs_to == 'admin')  
					                        				
							                        		<option value="{{$function->slug}}"
							                        			@if(in_array($function->slug, $admin_functions) == true)
							                        			selected
							                        			@php
						                        				$selected++;
						                        				@endphp   
							                        			@endif
							                        			menu="{{$menu->slug}}">
							                        			{{$function->function_name}}
							                        		</option>
							                        		@endif
						                        		@endforeach
					                        		</select>
					                            	<span class="help-block">
					                            		<small>{{$selected}} out of {{$total}} functions were selected.</small>
					                            	</span>
					                       		</div>
					                      	</div>
					                      	<div class="progress xs">
							                  <div class="progress-bar bg-blue" style="width: {{$selected/$total*100}}%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"  menu="{{$menu->slug}}">
							                  </div>
							                </div>
					                    @endif
				                    </div>
				                </div>	
							</div>
						@endforeach

					@endif
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