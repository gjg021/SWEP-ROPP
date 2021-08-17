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
                        <div class="col-md-12">
                            <div class="card-title">
                                <button id="addProduct" style="display: none" class="btn btn-primary mt-lg-1 center" onclick="addProduct()"><i class="fa fa-caret-right" ></i> Add</button>
                                <form id="order_of_payment_form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Transaction type:</label>
                                        <select class="form-control form-control-lg" name="transaction_code" id="transaction_type">
                                            <option disabled="" selected>Select</option>
                                            @if(count($transaction_types)> 0)
                                                @foreach($transaction_types as $key => $group)
                                                    <optgroup label="{{$key}}">
                                                        @foreach($group as $key2 => $trasaction_type)
                                                            <option transactionCode="{{$trasaction_type['transaction_code']}}" value="{{$key2}}" type="{{$trasaction_type['type']}}" amount="{{$trasaction_type['amount']}}">{{$trasaction_type['transaction_type']}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div id="divLabAnalysis">
                                    </div>
                                    <div id="amountString">
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label>Volume (Lkg/tc)</label>--}}
{{--                                        <input type="number" class="form-control form-control-lg" placeholder="Lkg/tc" name="volume"> x multiplier--}}
{{--                                    </div>--}}

                                    <div id="amount_container" style="display: none" class="dynamics">
                                        <div class="form-group">
                                            <label>Amount: </label>
                                            <input type="text" id="amount" name="amount" class="form-control form-control-lg" placeholder="00.00" autocomplete="off">
                                        </div>
                                    </div>
                                    <div id="volume_container" style="display: none" class="dynamics">
                                        <div class="form-group col-md-6">
                                            <label>Volume (Lkg/tc)</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="Lkg/tc" id="volume" name="volume">
                                        </div>
                                        <div class="form-group col-md-6">
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
                                    <button type="submit" class="btn btn-primary center"><i class="fa fa-caret-right"></i> Proceed</button>
                                    <div id="divProduct" style="display: none" class="dynamics">
                                        <table id="tbProduct" class="table">
                                            <thead>
                                                <tr>
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
        function addProduct(){
            var r = $("#LabAnalysis");
            var option1 = $("#LabAnalysis option[id='"+r.val()+"']");
            var names = option1.attr('name');
            $("#totalVolume").val(Number($("#totalVolume").val())+Number($("#volume").val()));
            $("#totalAmount").val(Number($("#totalAmount").val())+Number($("#volume_amount").val().replace("₱","")));
            var tr = '<tr id='+option1.attr('id')+'>' +
                '<td width="10%"><input type="text" name="tdID[]" id="tdID[]" class="form-control" value="'+option1.attr('id')+'"></td>'+
                '<td width="60%"><input type="text" name="tdNames[]" id="tdNames[]" class="form-control" value="'+names+'"></td>'+
                '<td width="15%"><input type="text" name="tdVolume[]" id="tdVolume[]" class="form-control" value='+$("#volume").val()+'></td>'+
                '<td width="15%"><input type="text" name="tdAmount[]" id="tdAmount[]" class="form-control" value='+$("#volume_amount").val()+'></td>'+
                '</tr>';
            $('tbody').append(tr);
        }

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

        $("#transaction_type").change(function(){
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

            if(type == 'volume'){
                $("#volume_container").slideDown();
            }if(type == 'user'){
                $("#amount_container").slideDown();
            }

            var stringLabAnalysis = "";
            if(option.attr('transactionCode') == 'PRE'){
                stringLabAnalysis = "<div class='form-group'>";
                stringLabAnalysis += "<label>Product</label>";
                stringLabAnalysis += "<select class='form-control form-control-lg' name='LabAnalysisName' id='LabAnalysis'>";
                stringLabAnalysis += "<option disabled='' selected>--Please select--</option>";
                stringLabAnalysis += "@if(count($lab_analysis)> 0)";
                stringLabAnalysis += "@foreach($lab_analysis as $key1 => $slug)";
                stringLabAnalysis += "<option onclick='changeProduct({{$slug['sucrose']}});' id='{{$key1}}' name='{{$slug['product_description']}}' value='{{$key1}}' sucrose='{{$slug['sucrose']}}'>{{$slug['product_description']}}</option>";
                stringLabAnalysis += "@endforeach";
                stringLabAnalysis += "@endif";
                stringLabAnalysis += "</select>";
                stringLabAnalysis += "</div>";

                $("#divProduct").slideDown();
                $("#addProduct").slideDown();
            }
            else {
                $("#addProduct").slideUp();
            }
            $("#divLabAnalysis").html(stringLabAnalysis);
        })

        function changeProduct(sucCont){
            var stringAmount = '';
            if(sucCont == 0){
                stringAmount = "<div><p>Sucrose Content: " + sucCont + "% <br>Fee: " + zeroContent + " / Application </p></div>";
                $("#volume_container").slideUp();
            }
            else if(sucCont > 0 && sucCont <= baseContent){
                stringAmount = "<div><p>Sucrose Content: " + sucCont + "% <br>Fee: " + belowPrice + " / Lkg-bag </p></div>";
                $("#volume_container").slideDown();
            }
            else if (sucCont > 0 && sucCont > baseContent) {
                stringAmount = "<div><p>Sucrose Content: " + sucCont + "% <br>Fee: " + abovePrice + " / Lkg-bag </p></div>";
                $("#volume_container").slideDown();
            }
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
    </script>
@endsection