@extends('admin-layouts.main-layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Laboratory Analysis
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="box box-default">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! __form::a_textbox( 4,'Search Client','searchClient', 'text', 'Search','', '')!!}
                            <br><a class="btn btn-primary btn-rounded searchClient" data-toggle="modal" data-target="#searchClientModal" data-placement="top"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</a>
                        </div>

                        <div id="divClientInfo">

                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.box -->
        </section>


@endsection

@section('modals')
    {!! __html::blank_modal('searchClientModal', '', 'style="width: 60%"') !!}

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 60%";>
            <div class="modal-content" style="margin-top: 100px">
                <form id="add_form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Lab Analysis
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            {!! __form::a_textbox( 12,'Client','userSlug', 'text', 'Client','', '')!!}
                                            {!! __form::a_textbox( 4,'Report Number','reportNumber', 'text', 'Report No.','', '')!!}
                                            {!! __form::a_textbox( 4,'Date Received','dateReceived', 'date', 'Date Received','', '')!!}
                                            {!! __form::a_textbox( 4,'Date Analyzed','dateAnalyzed', 'date', 'Date Analyzed','', '')!!}
                                            {!! __form::a_textbox( 4,'Sample Type','sampleType', 'text', 'Sample Type','', '')!!}
                                            {!! __form::a_textbox( 4,'Country of Origin','countryOfOrigin', 'text', 'Country of Origin','', '')!!}
                                            {!! __form::a_textbox( 4,'Sample Number','sampleNumber', 'text', 'Sample No.','', '')!!}
                                            {!! __form::a_textbox( 8,'Product','product', 'text', 'Product Description','', '')!!}
                                            {!! __form::a_textbox( 4,'Parameter','parameter', 'text', 'Parameter','', '')!!}
                                            {!! __form::a_textbox( 3,'Sucrose','sucrose', 'double', 'Sucrose','', '')!!}
                                            {!! __form::a_textbox( 3,'Glucose','glucose', 'double', 'Glucose','', '')!!}
                                            {!! __form::a_textbox( 3,'Lactose','lactose', 'double', 'Lactose','', '')!!}
                                            {!! __form::a_textbox( 3,'Fructose','fructose', 'double', 'Fructose','', '')!!}
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
        $("body").on("click",".searchClient", function(){
            btn = $(this);
            var search = document.getElementById("searchClient").value;
            if(search === "") {
                swal({
                    title: "Empty",
                    text: "Please provide search value.",
                    type: "warning"
                });
            }
            else {
                uri = "{{route('admin.labAnalysis.searchClient','searchValue')}}";
                uri = uri.replace('searchValue',search);
                loading_modal(btn);
                $.ajax({
                    url : uri,
                    type: 'GET',
                    success:function(response){
                        console.log(response)
                        populate_modal(btn,response);
                    },
                    error: function(response){
                        console.log(response)
                        errored_modal(btn,response);
                    }
                })
            }
        })

        $("body").on("click",".addLab", function(){
            var r = $(this);
            $("#userSlug").val(r.attr('data'));
            $("#addModal").modal('show');
        })

        $("body").on('click', '#tbClient tbody tr', function() {
            var selectedRecord = $(this);
            uri = "{{route('admin.labAnalysis.getClient','selectedRecord')}}";
            uri = uri.replace('selectedRecord',selectedRecord.attr('id'));
            $.ajax({
                url : uri,
                type: 'GET',
                success:function(response){
                    console.log(response)
                    $("#searchClientModal").modal('hide');
                    $("#divClientInfo").html(response);
                },
                error: function(response){
                    console.log(response)
                }
            })
        });

        $("#add_form").submit(function(e){
            e.preventDefault();
            form = $(this);
            formdata = form.serialize();
            loading_btn(form);
            $.ajax({
                url : "{{route('admin.labAnalysis.store')}}",
                data: formdata,
                type: 'POST',
                success: function(response){
                    $("#addModal").modal('hide');
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
    </script>
@endsection
