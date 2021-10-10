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
							<button id="add_btn" data-toggle="modal" data-target="#add_user_modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Create</button>
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
	<div id="add_user_modal" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width: 80%">
			<form id="add_user_form">
				<!-- Modal content-->
				<div class="modal-content">

					@csrf
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"> Add new client</h4>
					</div>
					<div class="modal-body">
						<div class="row">
								<div class="panel panel-default">
									<div class="panel-heading">
										Client Details
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12">
												{!! __form::a_textbox( 4,'Username','username', 'text', 'Username','', '')!!}
												{!! __form::a_textbox( 4,'Password','password', 'password', 'Password','', '')!!}
												{!! __form::a_textbox( 4,'Confirm Password','password_confirmation', 'password', 'Confirm Password','', '')!!}
											</div>
											<div class="col-sm-12">
												<div class="panel panel-primary">
													<div class="panel-heading">
														Personal Information
													</div>
													<div class="panel-body">
														<div class="row">
															{!! __form::a_textbox( 4,'Last Name','lastName', 'text', 'Last Name','', '')!!}
															{!! __form::a_textbox( 4,'First Name','firstName', 'text', 'First Name','', '')!!}
															{!! __form::a_textbox( 4,'Middle Name','middleName', 'text', 'Middle Name','', '')!!}
															{!! __form::a_textbox( 4,'Phone Number','phone', 'text', 'Phone Number','', '')!!}
															{!! __form::a_textbox( 4,'Email Address','email', 'text', 'Email Address','', '')!!}
															{!! __form::a_textbox( 4,'Birthday','birthday', 'date', 'Birthday','', '')!!}
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="panel panel-primary">
													<div class="panel-heading">
														Address
													</div>
													<div class="panel-body">
														<div class="row">
															{!! __form::a_textbox( 4,'Street','street', 'text', 'Street No./Lot No./Subd./Bldg.','', '')!!}
															{!! __form::a_textbox( 4,'Barangay','barangay', 'text', 'Barangay','', '')!!}
															{!! __form::a_textbox( 4,'Municipality/City','city', 'text', 'Municipality/City','', '')!!}
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="panel panel-primary">
													<div class="panel-heading">
														Business Information
													</div>
													<div class="panel-body">
														<div class="row">
															{!! __form::a_textbox( 12,'Business Name','businessName', 'text', 'Business Name','', '')!!}
															{!! __form::a_textbox( 4,'TIN','businessTin', 'text', 'TIN','', '')!!}
															{!! __form::a_textbox( 4,'Business Contact','businessContact', 'text', 'Business Contact','', '')!!}
															{!! __form::a_textbox( 4,'Position','position', 'text', 'Position','', '')!!}
															{!! __form::a_textbox( 4,'Street','businessStreet', 'text', 'Street No./Lot No./Subd./Bldg.','', '')!!}
															{!! __form::a_textbox( 4,'Barangay','businessBarangay', 'text', 'Barangay','', '')!!}
															{!! __form::a_textbox( 4,'Municipality/City','businessCity', 'text', 'Municipality/City','', '')!!}
														</div>
													</div>
												</div>
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

		$("#add_user_form").submit(function(e){
			e.preventDefault();
			form = $(this);
			formdata = form.serialize();
			$.ajax({
				url : "{{route('admin.users.store')}}",
				data: formdata,
				type: 'POST',
				success: function(response){
					swal({
						title: "Success!",
						text: "Successfully Registered.",
						type: "success"
					});
				},
				error: function(response){
					swal({
						title: "Failed!",
						text: "Failed Successfully.",
						type: "error"
					});
					errored(form,response);
				}
			})
		});
	});
</script>
@endsection