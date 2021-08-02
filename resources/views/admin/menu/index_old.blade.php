@extends('admin-layouts.main-layout')

@section('content')
	<section class="content-header">
      <h1>
        Menus & Submenus
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
					
				</div>
			</div>
		
    </section>

		


@endsection

@section('modals')

{{-- Add Modal --}}
<div id="add_menu_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 70% !important">

    <!-- Modal content-->
    <div class="modal-content">
    	<div class="form add_menu_form">
    		@csrf
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Create new menu</h4>
			</div>
      		<div class="modal-body">
        		
	        	<div class="row">
	        		<div class="col-md-3">
	        			<div class="box box-success box-solid">
				            <div class="box-body">
				              	<div class="row">
			        				{!! __form::a_textbox( 12,'Menu Name','menu_name', 'text', 'Name in the sidebar','', '')!!}
					        		{!! __form::a_textbox( 12,'Route','menu_route', 'text', 'Laravel Route','', '')!!}
					        		{!! __form::a_textbox( 12,'Icon','menu_icon', 'text', 'Icon','', '')!!}
					        		{!! __form::a_textbox( 12,'Label','menu_label', 'text', 'Sidebar group','', '')!!}
					        		{!! __form::a_select(6, 'Is nav', 'menu_is_nav', ['Yes' => 1, 'No' => '0'], '', '') !!}
					        		{!! __form::a_select(6, 'Is dropdown', 'menu_is_dropdown', ['Yes' => 1, 'No' => '0'], '', '') !!}
		        				</div>
				            </div>
		
				        </div>
	        			
	        		</div>
	        		<div class="col-md-9">
	        			<div class="panel panel-default">
	        				<div class="panel-heading">
				              	<div class="row">
				              		<div class="col-md-8">
					              		Functions
					              	</div>
					              	<div class="col-md-4">
					              		<button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add_function_modal"><i class="fa fa-plus"></i> Add Functions</button>
					              	</div>
				              	</div>
				            </div>
				            <div class="panel-body">
				              	<table class="table table-condensed submenu_table table-striped">
				              		<thead>
				              			<tr>
						                  <th {{-- style="width: 10px" --}}>Name</th>
						                  <th>Label</th>
						                  <th>Route</th>
						                  <th {{-- style="width: 40px" --}}>Nav</th>
						                  <th style="width: 120px">Action</th>
						                </tr>
				              		</thead>
					                <tbody>
						               
					             	</tbody>
					          	</table>
				            </div>
		
				        </div>
	        		</div>

	        	</div>
       
      		</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" data-dismiss="modal">Save</button>
			</div>
       	</div>
    </div>

  </div>
</div>


<div id="add_function_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<div class="modal-content" style="margin-top: 100px">
			<form id="add_funtion_form">
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
					<button type="submit" class="btn btn-default" >Add</button>
				</div>
			</form>
		</div>

	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		
	});

	submenu_tbl = $(".submenu_table").DataTable({
		"bLengthChange": false,
	});

	$("#add_funtion_form").submit(function(e){
		e.preventDefault();
		form = $(this);
		form_data = form.serializeArray();
		data = {};
		$.each(form_data, function(i,item){
			data[item.name] = item.value;
		});

		unique_id = 'fn-'+Math.random();

		console.log(data);
		submenu_tbl.row.add([
			data.function_name,
			data.function_label,
			data.function_route,
			data.function_is_nav,
			'<div class="btn-group"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="" title="" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i> Edit</button><button type="button" data="" class="btn btn-xs btn-danger remove_member " data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"><i class="fa fa-trash"></i> Remove</button></div>',
		]).draw().node().id = Math.random();

		form.get(0).reset();
	})

</script>
@endsection