@extends('layouts.admin-master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">My Transactions</h4>
            <div id="loading">
                <div class="circle-loader" style="margin-top: 200px; margin-bottom: 200px"></div>
            </div>
            <div id="my_payments_table_container" style="display: none">
                <div class="accordion basic-accordion" id="accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                    <i class="card-icon fa fa-filter"></i>Filters </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control form-control-lg select_filter border-info" name="status">
                                                <option value="Active">Active</option>
                                                <option value="All">All</option>
                                                <option value="To Pay">To Pay</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Expired">Expired</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Transaction Type:</label>
                                            <select class="form-control form-control-lg select_filter" name="transaction_type">
                                                <option value="All">All</option>
                                                <optgroup label="Issuance/Renewal of">
                                                    <option value="Milling/Refining Licenses">Milling/Refining Licenses</option>
                                                    <option value="Trader Licenses">Trader Licenses</option>
                                                    <option value="Muscovado Converters">Muscovado Converters</option>
                                                </optgroup>
                                                <optgroup label="Issuance of Clearances/Certifications">
                                                    <option value="Release of imported sugar molasses, etc.">Release of imported sugar molasses, etc.</option>
                                                    <option value="Certifications on Sugar Requirements">Certifications on Sugar Requirements</option>
                                                </optgroup>
                                                <optgroup label="Issuance of Permits">
                                                    <option value="Shipping Permits">Shipping Permits</option>
                                                </optgroup>
                                                <optgroup label="Monitoring of Imports(Clearances/Permit requirements)">
                                                    <option value="CBW Food Processors">CBW Food Processors</option>
                                                    <option value="Premixes">Premixes</option>
                                                    <option value="Specialty Sugars">Specialty Sugars</option>
                                                </optgroup>
                                                <option value="Liens">Liens</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="my_payments_table" class="table dataTable no-footer table-condensed" role="grid" aria-describedby="order-listing_info" style="width: 100% !important;">
                                <thead>
                                <tr>
                                    <th>Raw Date</th>
                                    <th>Transaction ID</th>
                                    <th>Transaction Type</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>

                                </tbody>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" tabindex="-1" role="dialog" id="view_modal">
        <div class="modal-dialog" role="document" style="max-width:60% !important;">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    my_payments_tbl = $("#my_payments_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax" : '{{ route("dashboard.payments.index") }}?status=Active',
        "pageLength" : 5,
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'All']],
        "columns": [
            { "data": "created_at" },
            { "data": "slug" },
            { "data": "transaction_type" },
            { "data": "payment_method" },
            { "data": "amount" },
            { "data": "status" },
            { "data": "action" },
        ],
        "order": [[ 0, "desc" ]],
        "columnDefs":[
            {
                "className":"action_column",
                "targets" : [5],
            },
            {
                "visible" : false,
                "targets": [0],
            }
        ],
        "language": {
            "processing": "<div class='flip-square-loader mx-auto'></div>",
        },
        "initComplete": function (settings,json) {
            console.log("#"+settings.sTableId+"_container");
            $("#loading").fadeOut(function () {
                $("#"+settings.sTableId+"_container").fadeIn();
            });

        }
    });

    $('#my_payments_table_filter input[type="search"]').unbind();
    $('#my_payments_table_filter input[type="search"]').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            my_payments_tbl.search(this.value).draw();
        }
    });

    $(".select_filter").change(function(){
        var status = $(".select_filter[name='status']").val();
        var transaction_type = $(".select_filter[name='transaction_type']").val();
        my_payments_tbl.ajax.url('{{ route("dashboard.payments.index") }}?status='+status+'&transaction_type='+transaction_type).load();

        $(".select_filter").each(function(){
            if($(this).val() != 'All'){
                $(this).addClass('border-info');
            }else{
                $(this).removeClass('border-info');
            }
        })
    })

    $("body").on("click",".view_btn", function () {
        target_modal = $(this).attr('data-target');

        tr_id = $(this).attr('data');
        uri  = "{{route('dashboard.payments.show', 'slug')}}";
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

</script>
@endsection