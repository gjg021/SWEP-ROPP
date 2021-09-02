@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Online Payments
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
                            <th>Action</th>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="view_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="update_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
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
                { "data": "total_amount" , "name": "order_of_payments.total_amount" },
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

        $("body").on("click",".view_btn", function () {
            target_modal = $(this).attr('data-target');

            tr_id = $(this).attr('data');
            uri  = "{{route('admin.payments.show', 'slug')}}";
            uri = uri.replace('slug',tr_id);
            $(target_modal+" .modal-content").html('<div class="loader-demo-box">\n' +
                '                    <div class="square-box-loader">\n' +
                '                        <div class="square-box-loader-container">\n' +
                '                            <div class="square-box-loader-corner-top"></div>\n' +
                '                            <div class="square-box-loader-corner-bottom"></div>\n' +
                '                        </div>\n' +
                '                        <div class="square-box-loader-square"></div>\n' +
                '                    </div>\n' +
                '                </div>');
            $.ajax({
                url: uri,
                type: 'GET',
                success: function (res) {
                    $(target_modal).find('.modal-content').html(res);
                },
                error: function (res) {
                    console.log(res);
                }
            })

        })

        $("body").on("click",".update_btn", function () {
            target_modal = $(this).attr('data-target');
            tr_id = $(this).attr('data');
            uri  = "{{route('admin.payments.edit', 'slug')}}";
            uri = uri.replace('slug',tr_id);
            $(target_modal+" .modal-content").html('<div class="loader-demo-box">\n' +
                '                    <div class="square-box-loader">\n' +
                '                        <div class="square-box-loader-container">\n' +
                '                            <div class="square-box-loader-corner-top"></div>\n' +
                '                            <div class="square-box-loader-corner-bottom"></div>\n' +
                '                        </div>\n' +
                '                        <div class="square-box-loader-square"></div>\n' +
                '                    </div>\n' +
                '                </div>');
            $.ajax({
                url: uri,
                type: 'GET',
                success: function (res) {

                    $(target_modal).find('.modal-content').html(res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })
    });
</script>
@endsection