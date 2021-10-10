@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Transaction Type
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Transaction Type</li>
        </ol>
    </section>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        Transaction TYpe
                    </div>
                    <div class="col-md-3">
                        <button id="add_btn" data-toggle="modal" data-target="#add_modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
                    <img src="{{ asset('images/load_anim.gif') }}">
                </div>


                <div id="transactionTypeTableContainer" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id="transactionTypeTable" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Unit</th>
                            <th>Fee Per Unit</th>
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
    {!! __html::blank_modal('edit_modal', '', 'style="width: 80%"') !!}

    <div id="add_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 80%";>
            <div class="modal-content" style="margin-top: 100px">
                <form id="add_form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Transaction Type</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Transaction Type
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            {!! __form::a_textbox( 4,'Slug','slug', 'text', 'Slug','', '')!!}
                                            {!! __form::a_textbox( 8,'Name','name', 'text', 'Name','', '')!!}
                                            {!! __form::a_textbox( 6,'Group','group', 'text', 'Group','', '')!!}
                                            {!! __form::a_textbox( 6,'Unit','unit', 'text', 'Unit','', '')!!}
                                            {!! __form::a_textbox( 4,'Fee Per Unit','feePerUnit', 'double', 'Fee Per Unit','', '')!!}
                                            {!! __form::a_textbox( 4,'Regular Fee','regularFee', 'double', 'Regular Fee','', '')!!}
                                            {!! __form::a_textbox( 4,'Expedite Fee','expediteFee', 'double', 'Expedite Fee','', '')!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            transactionTypeTbl =  $("#transactionTypeTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax" : '{{ route("admin.transactionType.index") }}',
                "columns": [
                    { "data": "slug"},
                    { "data": "name"},
                    { "data": "transaction_types_group_slug"},
                    { "data": "unit"},
                    { "data": "fee_per_unit"},
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
                        $("#transactionTypeTableContainer").fadeIn();
                    });
                    dt_press_enter('#transactionTypeTable_filter', transactionTypeTbl);
                },
                "language":
                    {
                        "processing": "<center><img style='width: 70px' src=''></center>",
                    },
                "drawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active != ''){
                        $("#transactionTypeTable #"+active).addClass('success');
                    }
                }
            });

            $("#add_form").submit(function(e){
                e.preventDefault();
                form = $(this);
                formdata = form.serialize();
                loading_btn(form);
                $.ajax({
                    url : "{{route('admin.transactionType.store')}}",
                    data: formdata,
                    type: 'POST',
                    success: function(response){
                        transactionTypeTbl.draw();
                        $('#add_modal').modal('hide');
                        swal({
                            title: "Success!",
                            text: "Successfully Added.",
                            type: "success"
                        });
                        succeed(form, true, false);
                        active = response.slug;
                    },
                    error: function(response){
                        errored(form,response);

                    }
                })
            });

            $("body").on("click",".edit_btn", function(){
                btn = $(this);
                slug = btn.attr('data');
                uri = "{{route('admin.transactionType.edit','slugg')}}";
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

            $("body").on("click",".delete_btn", function(){
                btn = $(this);
                slug = btn.attr('data');
                uri = "{{route('admin.transactionType.destroy','slugg')}}";
                uri = uri.replace('slugg',slug);
                swal({
                        title: "Delete Transaction Type?",
                        text: "Are you sure to DELETE this record?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, DELETE it!",
                        closeOnConfirm: false
                    },
                    function () {
                        delete_item(uri,btn,transactionTypeTbl);
                    });
            })

            $("body").on('submit',"#edit_form", function(e){
                e.preventDefault();
                form = $(this);
                formdata = form.serialize();
                slug = form.attr('data');
                uri = "{{route('admin.transactionType.update','slugg')}}";
                uri = uri.replace('slugg',slug);
                loading_btn(form);
                $.ajax({
                    url: uri,
                    data: formdata,
                    type: 'PATCH',
                    success:function(response){
                        transactionTypeTbl.draw();
                        $('#edit_modal').modal('hide');
                        swal({
                            title: "Success!",
                            text: "Successfully Updated.",
                            type: "success"
                        });
                        succeed(form,true,true);
                        active = response.slug;
                    },
                    error:function(response){
                        errored(form,response);
                        console.log(response);
                    }
                })
            })
        });
    </script>
@endsection