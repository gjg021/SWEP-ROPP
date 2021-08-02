@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Online Payments
{{--            <small>of Administrators</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Online Payments</li>
        </ol>
    </section>


    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        Online Payment List
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


                <div id="payments_table_container" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id = "payments_table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Transaction Type</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Status</th>
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
        payments_tbl =  $("#payments_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : '{{ route("admin.order_of_payments.index") }}',
            "columns": [
                { "data": "slug" , "name": "order_of_payments.slug"},
                { "data": "transaction_type", "name": "order_of_payments.transaction_type" },
                { "data": "created_at", "name": "order_of_payments.created_at"},
                { "data": "business_name", "name":"user.business_name" },
                { "data": "amount" , "name": "order_of_payments.amount" },
                { "data": "status" },
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
            "order" : [[2, 'desc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#payments_table_container").fadeIn();
                });
                dt_press_enter('#payments_table_filter',payments_tbl);
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src=''></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#payments_table #"+active).addClass('success');
                }
            }
        });
    });
</script>
@endsection