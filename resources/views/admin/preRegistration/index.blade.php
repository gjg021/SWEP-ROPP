@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Pre Registration
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pre Registration</li>
        </ol>
    </section>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        Pre Registration
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
                    <img src="{{ asset('images/load_anim.gif') }}">
                </div>


                <div id="preRegistrationTableContainer" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id="preRegistrationTable" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Phone Number</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        active = '';
        preRegistrationTbl =  $("#preRegistrationTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : '{{ route("admin.preRegistration.index") }}',
            "columns": [
                { "data": "slug"},
                { "data": "last_name"},
                { "data": "first_name"},
                { "data": "middle_name"},
                { "data": "phone"},
                { "data": "action" }
            ],
            "columnDefs":[
                {
                    "targets" : 5,
                    "orderable" : false,
                    "class" : 'action'
                },
                {
                    "targets": 3,
                    // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
                }
            ],
            "order" : [[2, 'desc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#preRegistrationTableContainer").fadeIn();
                });
                dt_press_enter('#preRegistrationTableFilter', preRegistrationTbl);
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src=''></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#preRegistrationTable #"+active).addClass('success');
                }
            }
        });
    });
</script>
@endsection