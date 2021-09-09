@extends('layouts.admin-master')
@section('content')
    <div class="row page-title-header">
        <div class="col-12">
            <div class="page-header">
                <h4 class="page-title">Payment</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content">
                            <div class="card-title">
                                <form id="order_of_payment_form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label>Department:</label>
                                            <select class="form-control form-control-lg" name="transaction_types_group" id="transaction_types_group">
                                                <option disabled="" selected>Select</option>
                                                @if(count($transaction_types_group)> 0)
                                                    @foreach($transaction_types_group as $key => $slug)
                                                        <option value="{{$key}}">{{$slug['group_name']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-sm-6" id="divTypeGroup">

                                        </div>

                                        <div class="col-sm-6" id="divTransactionTypesLabAnalysis">

                                        </div>
                                        <div class="col-sm-6" id="divLabAnalysis">

                                        </div>
                                        <div class="col-sm-12" id="amountString">

                                        </div>
                                        <div id="amount_container" style="display: none" class="col-sm-6 dynamics">
                                            <div class="form-group">
                                                <label>Amount: </label>
                                                <input type="text" id="amount" name="amount" class="form-control form-control-lg" placeholder="00.00" autocomplete="off">
                                            </div>
                                        </div>
                                            <div id="volume_container" style="display: none" class="col-sm-6 form-group dynamics">
                                                <label>Volume (Lkg/bag)</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Lkg/tc" id="volume" name="volume">
                                            </div>
                                            <div id="volume_container_amount" style="display: none" class="col-sm-6 form-group dynamics">
                                                <label>Amount: </label>
                                                <input type="text" name="volume_amount" id="volume_amount" class="form-control form-control-lg" value="0.00" readonly>
                                            </div>

                                            <div class="form-group" style="display: none">
                                                <label>Total Volume</label>
                                                <input id="totalVolume" name="totalVolume" type="text" class="form-control form-control-lg" placeholder="Lkg/tc">
                                            </div>
                                            <div class="form-group" style="display: none">
                                                <label>Total Amount</label>
                                                <input type="text" name="totalAmount" id="totalAmount" class="form-control form-control-lg" value="0" readonly>
                                            </div>
                                    </div>
                                    <button id="btnProceed" type="submit" class="btn btn-primary center"><i class="fa fa-caret-right"></i> Proceed</button>
                                    <div id="divProduct" style="display: none" class="dynamics mt-lg-3">
                                        <table id="tbProduct" class="table">
                                            <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product</th>
                                                <th>Volume</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Instructions:</h4>
                        @include('dashboard.includes.instructions')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
@endsection
@section('scripts')
    <script type="text/javascript">
        var baseContent = '{{$sucrose_contents['base_percentage']}}';
        var belowPrice = '{{$sucrose_contents['below_price']}}';
        var abovePrice = '{{$sucrose_contents['above_price']}}';
        var zeroContent = '{{$sucrose_contents['zero_content']}}';

        autonum_settings = {
            currencySymbol : ' ₱',
            decimalCharacter : '.',
            digitGroupSeparator : ',',
        };

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                },500);
            };
        }

        $('input[name="volume"]').keyup(delay(function (e) {
            lgktc = $(this).val();
            $.ajax({
                url: '{{route('dashboard.get_settings')}}?lkgtc_multiplier='+lgktc,
                type: 'GET',
                success: function(res){
                    $("#amount").val(res.amount);
                },
                error:function (res) {
                    console.log(res);
                }
            })
        }, 500));
        new AutoNumeric("#amount",autonum_settings);

        $("body").on('change', '#transaction_type', function() {
            var t = $(this);
            var option = $("#transaction_type option[value='"+t.val()+"']");
            var type = option.attr('type');
            var amount = option.attr('amount');
            var stringAmount = '';
            if(option.attr('transactionCode') != 'PRE'){
                stringAmount = type!='user'?"<div><p>Fee: " + amount + (type == 'volume'?' / ' + type:'') +"</p></div>":"";
            }

            $("#amountString").html(stringAmount);
            $(".dynamics input").each(function () {
                $(this).val('');
            })
            $(".dynamics").each(function(){
                $(this).slideUp();
            })

            if(type == 'VOLUME'){
                $("#volume_container").slideDown();
                $("#volume_container_amount").slideDown();
            }if(type == 'USER'){
                $("#amount_container").slideDown();
            }

            if(option.attr('transactionCode') == 'PRE'){
                $.ajax({
                    url : "{{route('dashboard.payments.getLabAnalysis')}}",
                    type: 'GET',
                    success: function (res) {
                        $("#divLabAnalysis").html(res);
                    },
                    error: function (res) {
                        console.log(res);
                        errored(form,res);
                    }
                })
                $("#divProduct").slideDown();
            }
            else if(option.attr('transactionCode') == 'LAB-010'){
                var url = "{{route('dashboard.payments.getLabAnalysisTypes', 'transactionCode') }}";
                var newUrl = url.replace('transactionCode', option.attr('transactionCode'))
                $.ajax({
                    url : newUrl,
                    type: 'GET',
                    success: function (res) {
                        $("#divTransactionTypesLabAnalysis").html(res);
                    },
                    error: function (res) {
                        console.log(res);
                        errored(form,res);
                    }
                })
            }
        })

        function addProductToList(){
            var r = $("#LabAnalysis");
            var option1 = $("#LabAnalysis option[id='"+r.val()+"']");
            var names = option1.attr('name');
            $("#totalVolume").val(Number($("#totalVolume").val())+Number($("#volume").val()));
            $("#totalAmount").val(Number($("#totalAmount").val())+Number($("#volume_amount").val().replace("₱","")));
            var table = $('#tbProduct')[0];
            if (table.rows[option1.attr('id')]) {
                var tdVol = $('#tbProduct tr[id='+option1.attr('id')+'] td input[name="tdVolume[]"]').val();
                var tdAmnt = $('#tbProduct tr[id='+option1.attr('id')+'] td input[name="tdAmount[]"]').val();
                $("#totalVolume").val(Number($("#totalVolume").val())-Number(tdVol));
                $("#totalAmount").val(Number($("#totalAmount").val())-Number(tdAmnt.replace("₱","")));
                $('#tbProduct tr[id='+option1.attr('id')+']').remove();

            }
            var tr = '<tr id='+option1.attr('id')+'>' +
                '<td width="15%"><label>'+option1.attr("id")+'</label> <input type="text" hidden name="tdID[]" id="tdID[]" class="form-control" value="'+option1.attr('id')+'" readonly></td>'+
                '<td width="55%"><label>'+names+'</label><input type="text" hidden name="tdNames[]" id="tdNames[]" class="form-control" value="'+names+'" readonly></td>'+
                '<td width="15%"><label>'+$("#volume").val()+'</label><input type="text" hidden name="tdVolume[]" id="tdVolume[]" class="form-control" value='+$("#volume").val()+' readonly></td>'+
                '<td class="text-lg-right" width="15%"><label>'+$("#volume_amount").val()+'</label><input type="text" hidden name="tdAmount[]" id="tdAmount[]" class="form-control" value='+$("#volume_amount").val()+' readonly></td>'+
                '<td><a href="javascript:void(0)" class="btn btn-danger deleteRow"><i class=\'fa fa-trash-o\' ></i></a></td>'+
                '</tr>';
            $('#tbProduct > tbody').append(tr);
        }

        $('#tbProduct > tbody').on('click', '.deleteRow', function() {
            $(this).parent().parent().remove();
        });

        function changeProduct(sucCont){
            var stringAmount = '';
            if(sucCont == 0){
                stringAmount = "<div><table class='table mb-lg-3'><tbody><tr><td width='20%'>Sucrose Content: " + sucCont + "%</td><td width='20%'>Fee: " +  zeroContent + " / Application </td></tr></tbody></table></div>";
                $("#volume_container").slideUp();
                $("#volume_container_amount").slideUp();
            }
            else if(sucCont > 0 && sucCont <= baseContent){
                stringAmount = "<div><table class='table mb-lg-3'><tbody><tr><td width='20%'>Sucrose Content: " + sucCont + "%</td><td width='20%'>Fee: " + belowPrice + " / Lkg-Bag </td></tr></tbody></table></div>";
                $("#volume_container").slideDown();
                $("#volume_container_amount").slideDown();
            }
            else if (sucCont > 0 && sucCont > baseContent) {
                stringAmount = "<div><table class='table mb-lg-3'><tbody><tr><td width='20%'>Sucrose Content: " + sucCont + "%</td><td width='20%'> Fee: " + abovePrice + " / Lkg-Bag </td></tr></tbody></table></div>";
                $("#volume_container").slideDown();
                $("#volume_container_amount").slideDown();
            }
            $("#volume").val('');
            $("#volume_amount").val('');
            $("#amountString").html(stringAmount);
        }

        $("#volume_container input[name='volume']").keyup(function () {
            var t = $("#transaction_type");
            var option = $("#transaction_type option[value='"+t.val()+"']");
            if(option.attr('transactionCode') == 'PRE'){
                var r = $("#LabAnalysis");
                var option1 = $("#LabAnalysis option[id='"+r.val()+"']");
                var sucCont = option1.attr('sucrose');
                if(sucCont > 0 && sucCont<=baseContent){
                    $("#volume_amount").val($(this).val()*belowPrice);
                    new AutoNumeric("#volume_amount",autonum_settings);
                }
                else if (sucCont > 0 && sucCont>baseContent) {
                    $("#volume_amount").val($(this).val()*abovePrice);
                    new AutoNumeric("#volume_amount",autonum_settings);
                }
            }
            else {
                $("#volume_amount").val($(this).val()*option.attr('amount'));
                new AutoNumeric("#volume_amount",autonum_settings);
            }

        })

        $("#order_of_payment_form").submit(function(e){
            e.preventDefault();
            form = $(this);
            formData = form.serialize();
            loading_btn(form);
            $.ajax({
                url : "{{route('dashboard.payments.validate_form')}}",
                data: formData,
                type: 'POST',
                success: function (res) {

                    $('.content-wrapper').html(res);

                },
                error: function (res) {
                    console.log(res);
                    errored(form,res);
                }
            })
        })

        $("#transaction_types_group").change(function(){
            var t = $(this);
            var option = $("#transaction_types_group option[value='"+t.val()+"']");
            var optionID = option.val();
            var url = "{{route('dashboard.payments.groupSelected', 'optionID') }}";
            var newUrl = url.replace('optionID', optionID)
            $.ajax({
                url : newUrl,
                type: 'GET',
                success: function (res) {
                    $('#divTypeGroup').html(res);
                },
                error: function (res) {
                    console.log(res);
                    errored(form,res);
                }
            })
        })
    </script>
@endsection