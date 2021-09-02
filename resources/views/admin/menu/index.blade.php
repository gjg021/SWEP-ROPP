@extends('admin-layouts.main-layout')

@section('content')
	<section class="content-header">
      <h1>
        Menus & Functions
        <small>of Administrators</small>
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
							Menu List
						</div>	
						
						<div class="col-md-3">
							<button id="add_btn" data-toggle="modal" data-target="#add_menu_modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Create</button>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
						<img src="{{ asset('images/load_anim.gif') }}">
					</div>
				
					
					<div id="menus_table_container" hidden="">
						<table class="table table-bordered table-condensed table-striped" id = "menus_table" style="width: 100%">
							<thead>
								<tr>
									<th style="width: 10px">Order</th>
									<th>Menu Name</th>
									<th>Route</th>
									<th>Functions</th>
									<th>Label</th>
									<th>Icon</th>
									<th>Nav</th>
									<th>Dropdown</th>
									<th>Belongs to</th>
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



{{-- Add Modal --}}
<div id="add_menu_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
  	<form id="add_menu_form">
	    <!-- Modal content-->
	    <div class="modal-content">
	    	
    		@csrf
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Create new menu</h4>
			</div>
      		<div class="modal-body">
              	<div class="row">
    				{!! __form::a_textbox( 12,'Menu Name','menu_name', 'text', 'Name in the sidebar','', '')!!}
	        		{!! __form::a_textbox( 12,'Route','menu_route', 'text', 'Laravel Route','', '')!!}
	        		{!! __form::a_textbox( 12,'Icon','menu_icon', 'text', 'Icon','', '')!!}
	        		{!! __form::a_textbox( 12,'Label','menu_label', 'text', 'Sidebar group','', '')!!}
	        		{!! __form::a_select(6, 'Is nav', 'menu_is_nav', ['Yes' => 1, 'No' => 0], '', '') !!}
	        		{!! __form::a_select(6, 'Is dropdown', 'menu_is_dropdown', ['Yes' => 1, 'No' => 0], '', '') !!}
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
{!! __html::blank_modal('functions_index_modal','xl') !!}
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
						{!! __form::a_textbox( 12,'Icon','function_icon', 'text', 'Function icon','', '')!!}
						{!! __form::a_select(6, 'Is nav', 'function_is_nav', ['Yes' => 1, 'No' => '0'], '', '') !!}
						{!! __form::a_select(6, 'Belongs to', 'function_belongs_to', ['Admin' => 'admin', 'User' => 'user'], '', '') !!}
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
		menus_tbl =  $("#menus_table").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax" : '{{ route("admin.menus.index") }}',
			"columns": [
			  { "data": "order" },
			  { "data": "menu_name" },
			  { "data": "route" },
			  { "data": "functions" },
			  { "data": "label" },
			  { "data": "icon" },
			  { "data": "is_nav" },
			  { "data": "is_dropdown" },
			  { "data": "belongs_to" },
			  { "data": "action" }
			],
			// buttons: [
			//     'copy', 'excel', 'pdf'
			// ],
			"columnDefs":[
			{
			  "targets" : 0,
			  "visible" : false
			},
			{
			  "targets" : 8,
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
					$("#menus_table_container").fadeIn();
				  });
				  dt_press_enter('#menus_table_filter',menus_tbl);
			},
			"language": 
			{          
			  "processing": "<center><img style='width: 70px' src=''></center>",
			},
			"drawCallback": function(settings){
				$('[data-toggle="tooltip"]').tooltip();
				$('[data-toggle="modal"]').tooltip();
				if(active != ''){
				   $("#menus_table #"+active).addClass('success');
				}
			}
		});
	});	


	//add new menu form
	$("#add_menu_form").submit(function(e){
		e.preventDefault();
		form = $(this);
		formdata = $(this).serialize();

		loading_btn(form);
		
		$.ajax({
			url:"{{ route('admin.menus.store')}}",
			data: formdata,
			type: 'POST',
			headers: {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(response){
				succeed(form, true);
				active = response.slug;
				menus_tbl.draw();
		    },
		    error: function(response){
	    		errored(form,response);
		    }
		})

	});


	//index of functions -- .functions_index_btn click
	$('body').on('click','.functions_index_btn', function(){
		b = $(this);//button
		m = b.attr('data-target');//modal
		$(m+" .modal-content").html(modal_loader);
		slug = b.attr('data');
		uri = "{{route('admin.functions.index',['menu_slug'=> 'slugg'])}}";
		uri = uri.replace('slugg', slug);
		$("#add_funtion_form").attr('data',slug);
		$.ajax({
			url : uri,
			type: 'GET',
			data: slug,
			success: function(response){
				populate_modal(b, response);
			},
			error: function(response){
				console.log(response);
			}
		})
	})

	$("body").on("submit","#add_funtion_form", function(e){
		e.preventDefault();
		form = $(this);
		menu_slug = form.attr('data');
		loading_btn(form);
		uri = '{{route("admin.functions.store",["menu_slug" => "menu_slugg"])}}';
		uri = uri.replace("menu_slugg",menu_slug);

		$.ajax({
			url: uri,
			type: 'POST',
			data: form.serialize(),
			success: function(response){

				succeed(form,true,false);
				function_active = response.slug;
				functions_tbl.draw();
				active = response.menu_slug;
				menus_tbl.draw();
			},
			error: function(response){
				errored(form,response);
			}
		})
	});

	//DELETE MENU
	$("body").on('click',".delete_menu_btn", function(){
		btn = $(this);
        uri = "{{route('admin.menus.destroy','slugg')}}";
        delete_item(uri,btn,menus_tbl);
	})

	$("body").on("click", ".delete_function_btn", function(){
		btn = $(this);
		uri = "{{route('admin.functions.destroy','slugg')}}";
		delete_item(uri,btn,functions_tbl);
	})

	$("body").on("click",".edit_menu_btn",function(){
		btn = $(this);
		slug = btn.attr('data');
		uri = "{{route('admin.menus.edit','slugg')}}";
		uri = uri.replace('slugg',slug);

		loading_modal(btn);
		
		$.ajax({
			url: uri,
			type: 'GET',
			success: function(response){
				populate_modal(btn, response);
				
			},
			error: function(response){
				console.log(response);
			}
		})

	});

	$('body').on('submit',"#edit_menu_form",function(e){
		e.preventDefault();
		form = $(this);
		slug = form.attr('data');
		formdata = form.serialize();
		uri = "{{route('admin.menus.update','slugg')}}";
		uri = uri.replace('slugg', slug);
		loading_btn(form);
		$.ajax({
			url: uri,
			data: formdata,
			type: 'PUT',
			success: function(response){
				succeed(form,true,true);
				active = response.slug;
				menus_tbl.draw();
			},
			error: function(response){
				errored(form,response);
			}
		})
	});

	$("body").on("click",'.edit_function_btn',function(){
		btn = $(this);
		slug = btn.attr('data');
		uri = "{{route('admin.functions.edit','slugg')}}";
		uri = uri.replace('slugg',slug);
		loading_modal(btn);
		$.ajax({
			url: uri,
			type: 'GET',
			success: function(response){
				populate_modal(btn, response);
			},
			error: function(response){
				console.log(response);
			}
		})
	});

	$('body').on('submit',"#edit_function_form",function(e){
		e.preventDefault();
		form = $(this);
		formdata = form.serialize();
		slug = form.attr('data');
		uri = "{{route('admin.functions.update','slugg')}}";
		uri = uri.replace('slugg',slug);
		loading_btn(form);
		$.ajax({
			url : uri,
			data : formdata,
			type : 'PUT',
			success: function(response){
				succeed(form,true,true);
				function_active = response.slug
				functions_tbl.draw();
				active = response.menu_slug;
				menus_tbl.draw();
			},
			error:function (response){
				errored(form,response);
			}
		})
	})

	$("body").on("click",".add_resource_btn", function(){
		btn = $(this);
		type = "add_resource";
		main_route = btn.attr("route");
		menu_slug = btn.attr('data');
		data = {'type': type, 'main_route': main_route, 'menu_slug' : menu_slug};
		$.confirm({
		    title: 'Add resources?',
		    content: 'This will automatically add INDEX, STORE, EDIT, UPDATE, SHOW, DESTROY functions under the route:'+ main_route,
		    buttons: {
		        delete:{
		        	text: 'Proceed',
		        	btnClass : 'btn-success',
		        	action: function(){
		        		$.ajax({
		        			url: "{{route('admin.functions.add_resource')}}",
		        			data: data,
		        			type: 'POST',
		        			headers: {
						      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
		        			success: function(response){
		        				if(response == 1){
		        					notify_custom('Resources were added successfully','success');
		        					functions_tbl.draw();
		        				}
		        			},
		        			error: function(response){
		        				console.log(response);
		        			}
		        		})
		        	}
		        },
		        cancel: function () {
		            notify_custom('Not a single resource was added','warning');
		        }
		        
		    }
		});
	})



</script>
@endsection