@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Sucrose Content
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sucrose</li>
        </ol>
    </section>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        Sucrose Content
                    </div>

{{--                    <div class="col-md-3">--}}
{{--                        <button id="add_btn" data-toggle="modal" data-target="#add_menu_modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Create</button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="panel-body">
                <div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
                    <img src="{{ asset('images/load_anim.gif') }}">
                </div>


                <div id="sucrose_content_table_container" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id="sucrose_content_table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Base Percentage</th>
                            <th>Price Below Base Percentage</th>
                            <th>Price Above Base Percentage</th>
                            <th>Zero Sucrose Content</th>
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
        sucrose_content_tbl =  $("#sucrose_content_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : '{{ route("admin.sucrose.index") }}',
            "columns": [
                { "data": "slug" , "name": "sucrose_content.slug"},
                { "data": "base_percentage", "name": "sucrose_content.base_percentage" },
                { "data": "below_price", "name": "sucrose_content.below_price"},
                { "data": "above_price", "name":"sucrose_content.above_price" },
                { "data": "zero_content" , "name": "sucrose_content.zero_content" },
                { "data": "action" }
            ],
            // buttons: [
            //     'copy', 'excel', 'pdf'
            // ],
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
                    $("#sucrose_content_table_container").fadeIn();
                });
                dt_press_enter('#sucrose_content_table_filter',sucrose_content_tbl);
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src=''></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#sucrose_content_table #"+active).addClass('success');
                }
            }
        });
    });
</script>
@endsection