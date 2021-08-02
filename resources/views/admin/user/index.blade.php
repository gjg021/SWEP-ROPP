@extends('admin-layouts.main-layout')

@section('content')
	<section class="content-header">
      <h1>
        Registered Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>


    <section class="content">
    	
			<div class="panel panel-default">
				<div class="panel-heading">
					
					<div class="row">
						<div class="col-md-9">
							List of Users
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
				
					
					<div id="users_table_container" hidden="">
						<table class="table table-bordered table-condensed table-striped" id = "users_table" style="width: 100%">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Username</th>
									<th>Email Address</th>
									<th>Phone</th>
									<th>Activated</th>
									<th>Verified</th>
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
		users_tbl =  $("#users_table").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax" : '{{ route("admin.users.index") }}',
			"columns": [
			  { "data": "full_name" },
			  { "data": "username" },
			  { "data": "email" },
			  { "data": "phone" },
			  { "data": "is_active" },
			  { "data": "is_verified" },
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
			    $("#users_table_container").fadeIn();
			  });
			  dt_press_enter('#users_table_filter',users_tbl);
			},
			"language": 
			{          
			  "processing": "<center><img style='width: 70px' src=''></center>",
			},
			"drawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();
			$('[data-toggle="modal"]').tooltip();
			if(active != ''){
			   $("#users_table #"+active).addClass('success');
			}
			}
		});
	});	


	


</script>
@endsection