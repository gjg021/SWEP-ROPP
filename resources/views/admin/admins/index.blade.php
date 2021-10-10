@extends('admin-layouts.main-layout')

@section('content')
	<section class="content-header">
      <h1>
        Administrators
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Menus</li>
      </ol>
    </section>


    <section class="content">
    	
			<div class="panel panel-default">
				<div class="panel-heading">
					
					<div class="row">
						<div class="col-md-9">
							List of Administrators
						</div>	
						
						<div class="col-md-3">
							<button id="add_btn" data-toggle="modal" data-target="#add_admin_modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add</button>

							{{-- <button id="test_btn" data-toggle="" data-target="" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> test</button> --}}
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
						<img src="{{ asset('images/load_anim.gif') }}">
					</div>
				
					
					<div id="admins_table_container" hidden="">
						<table class="table table-bordered table-condensed table-striped" id = "admins_table" style="width: 100%">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Username</th>
									<th>Email</th>
									<th>Position</th>
									<th>Color</th>
									<th>Active</th>
									<th style="width: 100px">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
			          	</table>
			        </div>
				</div>
			</div>
    </section>

@endsection

@section('modals')

{!! __html::blank_modal('edit_admin_modal', '', 'style="width: 80%"') !!}

{{-- Add Modal --}}
<div id="add_admin_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80%">
  	<form id="add_admin_form">
	    <!-- Modal content-->
	    <div class="modal-content">
	    	
    		@csrf
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Add new administrator</h4>
			</div>
      		<div class="modal-body">
              	<div class="row">
    				<div class="col-md-3">
    					<div class="panel panel-default">
    						<div class="panel-heading">
    							Administrator Details
    						</div>

    						<div class="panel-body">
    							<div class="row">
		    						{!! __form::a_textbox( 12,'First Name','first_name', 'text', 'First Name','', '')!!}
		    						{!! __form::a_textbox( 12,'Middle Name','middle_name', 'text', 'Middle Name','', '')!!}

		    						{!! __form::a_textbox( 12,'Last Name','last_name', 'text', 'Last Name','', '')!!}

		    						{!! __form::a_textbox( 12,'Email Address','email', 'text', 'Email Address','', '')!!}

		    						{!! __form::a_textbox( 12,'Position','position', 'text', 'Position','', '')!!}

		    						{!! __form::a_textbox( 12,'Username','username', 'text', 'Username','', '')!!}

		    						{!! __form::a_textbox( 12,'Password','password', 'password', 'Password','', '')!!}

		    						{!! __form::a_textbox( 12,'Confirm Password','password_confirmation', 'password', 'Confirm Password','', '')!!}

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
									                      	<div class="row">
									                        	<div class="col-sm-12">
									                        		<select multiple="" name="menus[{{$menu->slug}}][]" class="form-control select_multiple" size="6" menu="{{$menu->slug}}">
									                        			@foreach($menu->functions as $function)            
											                        		@if($function->function_belongs_to == 'admin')
											                        			<option value="{{$function->slug}}" menu="{{$menu->slug}}">
											                        			{{$function->function_name}}
											                        		</option>
											                        		@endif
										                        		@endforeach
									                        		</select>
									                            	<span class="help-block">
									                            		<small>0 out of {{$menu->functions->where('belongs_to','=','admin')->count()}} functions were selected.</small>
									                            	</span>
									                       		</div>
									                      	</div>
									                      	<div class="progress xs">
											                  <div class="progress-bar bg-blue" style="width: 0%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"  menu="{{$menu->slug}}">
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
      		</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">
				<i class="fa fa-check"></i> Save
				</button>
			</div>
	       	
	    </div>
    </form>
  </div>
</div>


{{-- Function INDEX Modal --}}
{!! __html::blank_modal('functions_index_modal','lg') !!}
{!! __html::blank_modal('edit_menu_modal','sm') !!}
{!! __html::blank_modal('edit_function_modal','sm' ,'style="margin-top:100px"') !!}

{{-- Add Function Modal --}}
<div id="add_function_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" style="margin-top: 100px">
			<form id="add_funtion_form">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Function</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						{!! __form::a_textbox( 12,'Name','function_name', 'text', 'Name of Function','', '')!!}
						{!! __form::a_textbox( 12,'Label','function_label', 'text', 'This may show in sidebar','', '')!!}
						{!! __form::a_textbox( 12,'Route','function_route', 'text', 'Function route','', '')!!}
						{!! __form::a_select(12, 'Is nav', 'function_is_nav', ['Yes' => 1, 'No' => '0'], '', '') !!}
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" ><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		active = '';
		admins_tbl =  $("#admins_table").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax" : '{{ route("admin.admins.index") }}',
			"columns": [
			  { "data": "fullname" },
			  { "data": "username" },
			  { "data": "email" },
			  { "data": "position" },
			  { "data": "color" },
			  { "data": "is_activated" },
			  { "data": "action" }
			],
			// buttons: [
			//     'copy', 'excel', 'pdf'
			// ],
			"columnDefs":[
			{
			  "targets" : 6,
			  "orderable" : false,
			  "class" : 'action'
			},
			{
			  "targets": 3, 
			  // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
			}
			],
			"order" : [[0, 'asc']],
			"responsive": false,
			"initComplete": function( settings, json ) {
			  $('#tbl_loader').fadeOut(function(){
			    $("#admins_table_container").fadeIn();
			  });
			  dt_press_enter('#admins_table_filter',admins_tbl);
			},
			"language": 
			{          
			  "processing": "<center><img style='width: 70px' src=''></center>",
			},
			"drawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();
			$('[data-toggle="modal"]').tooltip();
			if(active != ''){
			   $("#admins_table #"+active).addClass('success');
			}
			}
		});
	});	

	$("#add_admin_form").submit(function(e){
		e.preventDefault();
		form = $(this);
		formdata = form.serialize();
		loading_btn(form);
		$.ajax({
			url : "{{route('admin.admins.store')}}",
			data: formdata,
			type: 'POST',
			success: function(response){
				succeed(form, true, false);
				active = response.slug;
				admins_tbl.draw();
			},
			error: function(response){
				errored(form,response);

			}
		})
	});

	$("body").on("click",".edit_admin_btn", function(){
		btn = $(this);
		slug = btn.attr('data');
		uri = "{{route('admin.admins.edit','slugg')}}";
		uri = uri.replace('slugg',slug);
		loading_modal(btn);
		$.ajax({
			url : uri,
			type: 'GET',
			success:function(response){
				populate_modal(btn,response);
			},
			error: function(response){
				errored_modal(btn,response);
			}
		})
	})

	$("body").on('submit',"#edit_admin_form", function(e){
		e.preventDefault();
		form = $(this);
		formdata = form.serialize();
		slug = form.attr('data');
		uri = "{{route('admin.admins.update','slugg')}}";
		uri = uri.replace('slugg',slug);
		loading_btn(form);
		$.ajax({
			url: uri,
			data: formdata,
			type: 'PATCH',
			success:function(response){
				succeed(form,true,true);
				active = response.slug;
				admins_tbl.draw();
			},
			error:function(response){
				errored(form,response);
				console.log(response);
			}
		})
	})

	$("body").on("click", ".delete_admin_btn", function(){
		btn = $(this);
		uri = "{{route('admin.admins.destroy','slugg')}}";
		delete_item(uri,btn,admins_tbl);
	})

	$('body').on('click','.clear_btn', function(){
		menu = $(this).attr('menu');
		$("option[menu='"+menu+"']").prop('selected',false);
		$("select[menu='"+menu+"'").change();
	});

	$("body").on('change','.select_multiple',function(){
		t = $(this);
		total = $(this)[0].length;
		id = $(this)[0].id;
		selected = 0;
		t.children('option:selected').each(function(){
			selected++;
		});

		t.siblings('.help-block').children('small').html(selected +" out of "+total+" functions were selected");
		percentage = selected/total*100;
		$(".progress-bar[menu='"+t.attr('menu')+"']").css('width',percentage+'%')
	})
</script>
@endsection