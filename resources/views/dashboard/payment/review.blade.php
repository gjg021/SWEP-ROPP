
    <style>
        .fileinput-upload{
            float: right !important;
         }
    </style>


    <div class="row page-title-header">
        <div class="col-12">
            <div class="page-header">
                <h4 class="page-title">Review Payment Details</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="done" class="text-center" style="padding-bottom: 50px; display: none">
                        <h4>Transaction ID:</h4>
                        <h2><code id="transaction_id"></code></h2>
                        <h4 id="amountToPay"></h4>
                        <h5 id="timestamp"></h5>
                        <img  width="600" src="{{asset('images/payment.gif')}}" style="margin-bottom: 30px">
                        <h4>We redirected you to the {{$response->payment_method}}</h4>
                    </div>
                    <div id="content">
                        <div class="row justify-content">
                            <div class="col-md-12">
                                <h4> Summary</h4>
                                @if($response->transaction_code == "PRE")
                                    <form id="premixProductForm">
                                        @csrf
                                        <div class="form-group">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Product ID</th>
                                                    <th>Product</th>
                                                    <th>Volume</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody id="">
                                                @if(count($premixProduct)> 0)
                                                    @foreach($premixProduct as $key1 => $tdID)
                                                        <tr id="">
                                                            <td width="15%">
                                                                <label>{{$tdID['tdID']}}</label>
                                                                <input type="text" hidden name="tdID[]" id="tdID[]" class="form-control" value="{{$tdID['tdID']}}" readonly>
                                                            </td>
                                                            <td width="55%">
                                                                <label>{{$tdID['tdProduct']}}</label>
                                                                <input type="text" hidden name="tdNames[]" id="tdNames[]" class="form-control" value="{{$tdID['tdProduct']}}" readonly>
                                                            </td>
                                                            <td width="15%">
                                                                <label>{{$tdID['tdVolume']}}</label>
                                                                <input type="text" hidden name="tdVolume[]" id="tdVolume[]" class="form-control" value="{{$tdID['tdVolume']}}" readonly>
                                                            </td>
                                                            <td class="text-lg-right" width="15%">
                                                                <label>₱ {{$tdID['tdAmount']}}</label>
                                                                <input type="text" hidden name="tdAmount[]" id="tdAmount[]" class="form-control" value="{{$tdID['tdAmount']}}" readonly>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                @endif
                                <table class="table mb-5">
                                    <tbody>
                                    <tr>
                                        <td width="25%">Transaction Type</td>
                                        <td width="5%">:</td>
                                        <td>{{$response->transaction_type}}</td>
                                    </tr>
                                    @if(!empty($response->volume))
                                        <tr>
                                            <td width="25%">Volume</td>
                                            <td width="5%">:</td>
                                            <td>{{$response->volume}} Lkg/tc</td>
                                        </tr>
                                    @endif
                                    @if(!empty($response->totalVolume))
                                        <tr>
                                            <td width="25%">Volume</td>
                                            <td width="5%">:</td>
                                            <td>{{$response->totalVolume}} Lkg/tc</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td width="25%">Payment method</td>
                                        <td width="5%">:</td>
                                        <td>{{$response->payment_method}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="font-size: larger; font-weight: 600">Total Amount</td>
                                        <td width="5%">:</td>
                                        <td style="font-size: larger; font-weight: 600" class="font-weight-bold">{{number_format($response->amount,2)}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <p class="text-danger">LandBank LinkBiz Portal imposes service fee on top of the total amount to be paid.</p>
                        </div>
                        <hr>
                        <div class="alert alert-fill-primary" role="alert">
                            <i class="mdi mdi-alert-circle"></i> Please attach supporting documents.
                        </div>
                        <p class="text-primary"> Attaching supporting document is <span class="text-danger font-weight-bold">required</span>. A regulation officer will check these documents before processing your request.</p>
                        <div class="file-loading">
                            <input type="file" id="input-100" name="files[]" accept="pdf" multiple hidden>
                        </div>
                        <button class="btn btn-primary float-right" type="button" id="confirm_payment_btn"><i class="fa fa-check"></i>Confirm and Proceed to Payment</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Instructions:</h4>
                        @include('dashboard.includes.instructions')
                    <hr>
                    @php
                        $drs = App\Models\User\DocumentaryRequirement::where('transaction_type',$response->transaction_code)->orderBy('sort','asc')->get();
                    @endphp
                    @if($drs->count() > 0)
                        <h4 class="card-title text-danger">Documentary Requirements for <b>{{strtoupper($response->transaction_type)}}</b>:</h4>
                        <ol >
                        @foreach($drs as $dr)
                            <li>{{$dr->document}}</li>
                        @endforeach
                        </ol>
                    @else
                        <div class="alert alert-primary" role="alert"> <b>NO</b> documentary requirements required for <b>{{strtoupper($response->transaction_type)}}</b> </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{--<div id="pay_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="margin-top: 100px">
                <form id="pay_modal_form">
                    <div class="modal-header">
                        <h5 class="modal-title"><code>LandBank LinkBiz Portal</code></h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Transaction Type:</td>
                                <td>{{$response->transaction_type}}</td>
                            </tr>
                            @if(!empty($response->product))
                                <tr>
                                    <td>Product:</td>
                                    <td>{{$response->product}}</td>
                                </tr>
                            @endif
                            @if(!empty($response->volume))
                                <tr>
                                    <td>Volume:</td>
                                    <td>{{$response->volume}} Lkg/tc</td>
                                </tr>
                            @endif
                            @if(!empty($response->totalVolume))
                                <tr>
                                    <td>Volume:</td>
                                    <td>{{$response->totalVolume}} Lkg/tc</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Payment method:</td>
                                <td>{{$response->payment_method}}</td>
                            </tr>
                            <tr>
                                <td style="font-size: larger; font-weight: 600">Amount:</td>
                                <td style="font-size: larger; font-weight: 600" class="font-weight-bold">{{number_format($response->amount,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>--}}

<script type="text/javascript">
    $(document).ready(function(){
        uploader = $("#input-100").fileinput({
            uploadUrl: "{{route('dashboard.payments.store')}}",
            enableResumableUpload: false,
            resumableUploadOptions: {
                // uncomment below if you wish to test the file for previous partial uploaded chunks
                // to the server and resume uploads from that point afterwards
                // testUrl: "http://localhost/test-upload.php"
            },
            uploadExtraData: {
                '_token': $("meta[name='csrf-token']").attr('content'),
                'transaction_code' : "{{$response->transaction_code}}",
                'payment_method' : "{{$response->payment_method}}",
                @if(!empty($response->volume))
                'volume' : "{{$response->volume}}",
                @endif
                        @if(!empty($response->totalVolume))
                'totalVolume' : "{{$response->totalVolume}}",
                @endif
                'amount' : "{{$response->amount}}",
            },
            maxFileCount: 5,
            minFileCount: 1,
            showCancel: true,
            initialPreviewAsData: true,
            overwriteInitial: false,
            theme: 'fa',
            deleteUrl: "http://localhost/file-delete.php",
            browseOnZoneClick: true,
            showBrowse: false,
            showCaption: false,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            uploadAsync: false
        }).on('fileloaded', function(event, previewId, index, fileId) {
            $(".kv-file-upload").each(function () {
                $(this).remove();
            })
        }).on('fileuploaderror', function(event, data, msg) {
            icon = $("#confirm_payment_btn i");
            icon.removeClass('fa-spinner');
            icon.removeClass('fa-spin');
            icon.addClass(' fa-check');
            $("#confirm_payment_btn").removeAttr('disabled');
            console.log('File Upload Error', 'ID: ' + data.fileId + ', Thumb ID: ' + data.previewId);
        }).on('filebatchuploaderror', function(event, data, msg) {
            icon = $("#confirm_payment_btn i");
            icon.removeClass('fa-spinner');
            icon.removeClass('fa-spin');
            icon.addClass(' fa-check');
            $("#confirm_payment_btn").removeAttr('disabled');
            console.log('File Upload Error', 'ID: ' + data.fileId + ', Thumb ID: ' + data.previewId);
        }).on('filebatchuploadsuccess', function(event, data) {
            console.log(data.response);
            var id = data.response.transaction_id;
            if(data.response.transaction_code == "PRE"){
                form = $("#premixProductForm");
                formData = form.serialize();
                $.ajax({
                    url : "http://localhost:8001/dashboard/OOP/"+id,
                    data: formData,
                    type: 'POST',
                    success: function (res) {
                        window.open("http://localhost:8001/dashboard/landBank/"+id, '_blank').focus();
                    },
                    error: function (res) {
                        alert("error");
                    }
                });
            }
            else {
                window.open("http://localhost:8001/dashboard/landBank/"+id, '_blank').focus();
            }
            $("#transaction_id").html(data.response.transaction_id);
            $("#amountToPay").html("Amount to Pay: Php "+ data.response.amount);
            $("#timestamp").html(data.response.timestamp);
            $('#pay_modal').modal('show');
            setTimeout(function(){
                $("#done").slideDown();
                $("#content").slideUp();
            },500);
            //window.open("http://localhost:8001/dashboard/landBank/"+id, '_blank').focus();
            //data.response is the object containing the values
        }).on('fileerror',function(event,data,msg){
            icon = $("#confirm_payment_btn i");
            icon.removeClass('fa-spinner');
            icon.removeClass('fa-spin');
            icon.addClass(' fa-check');
            $("#confirm_payment_btn").removeAttr('disabled');
        });
    })

    $("#confirm_payment_btn").click(function(){
        $(this).attr("disabled","disabled");
        icon = $("#confirm_payment_btn i");
        icon.removeClass('fa-check');
        icon.addClass('fa-spinner fa-spin');
        uploader.fileinput('upload');
    })

    $(window).focus(function () {
        console.log('Im focused');
    })
</script>
