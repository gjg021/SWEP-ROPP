 <style>
     fileinput-upload{
            float: right !important;
         }
 </style>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Review Payment Details</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <div id="done" class="text-center" style="padding-bottom: 50px; display: none">
                            <h4>Transaction ID:</h4>
                            <h2><code id="transaction_id"></code></h2>
                            <h4 id="amountToPay"></h4>
                            <h5 id="timestamp"></h5>
                            <img  width="600" src="{{asset('images/payment.gif')}}" style="margin-bottom: 30px">
                            <h4>We redirected you to the {{$response->payment_method}}</h4>
                            <button class="btn btn-primary" id="btnPrint">Print</button>
                            <iframe hidden id="printIframe" src="">

                            </iframe>
                        </div>
                        <div id="content">
                            <div class="row justify-content">
                                <div class="col-md-12">
                                    <h4> Summary</h4>
                                    @if($response->transaction_code == "PRE" || $response->transaction_types_group == "LAB")
                                        <form id="premixProductForm">
                                            @csrf
                                            @if($response->transaction_types_group == "LAB")
                                                <div>
                                                    @foreach($transactionTypesLabAnalysis as $key1)
                                                        <input type="text" hidden name="isExpedite[]" id="isExpedite[]" class="form-control" value="{{$key1['isExpedite']}}" readonly>
                                                        <input type="text" hidden name="tdLabSlugs[]" id="tdLabSlugs[]" class="form-control" value="{{$key1['slug']}}" readonly>
                                                        <input type="text" hidden name="tdLabNames[]" id="tdLabNames[]" class="form-control" value="{{$key1['name']}}" readonly>
                                                        <input type="text" hidden name="tdLabFees[]" id="tdLabFees[]" class="form-control" value="{{$key1['amount']}}" readonly>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if($response->transaction_code == "PRE")
                                                <div class="form-group m-b-lg">
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
                                                                        <label>PHP {{number_format($tdID['tdAmount'],2)}}</label>
                                                                        <input type="text" hidden name="tdAmount[]" id="tdAmount[]" class="form-control" value="{{$tdID['tdAmount']}}" readonly>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </form>
                                    @endif
                                    <table class="table mb-5">
                                        <tbody>
                                        <tr>
                                            <td width="25%"><strong>Transaction Type</strong></td>
                                            <td width="5%">:</td>
                                            <td>{{$response->transaction_type}}
                                            </td>
                                        @if($response->transaction_types_group == "LAB")
                                            <tr>
                                                <td width="25%"></td>
                                                <td width="5%"></td>
                                                <td>
                                                    <ul style="font-size: x-small">

                                                        @foreach($transactionTypesLabAnalysis as $key1)
                                                            <li>{{$key1['name']}}</li>
                                                        @endforeach

                                                    </ul>
                                                </td>
                                            </tr>
                                            @endif
                                            </tr>
                                            @if(!empty($response->volume))
                                                <tr>
                                                    <td width="25%"><strong>Volume</strong></td>
                                                    <td width="5%">:</td>
                                                    <td>{{$response->volume}} Lkg/tc</td>
                                                </tr>
                                            @endif
                                            @if(!empty($response->totalVolume))
                                                <tr>
                                                    <td width="25%"><strong>Volume</strong></td>
                                                    <td width="5%">:</td>
                                                    <td>{{$response->totalVolume}} Lkg/tc</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td width="25%"><strong>Payment method</strong></td>
                                                <td width="5%">:</td>
                                                <td>{{$response->payment_method}}</td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><strong>Total Amount</strong></td>
                                                <td width="5%">:</td>
                                                <td style="font-size: larger; font-weight: 600" class="font-weight-bold">PHP {{number_format($response->amount,2)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <p class="text-danger">LandBank LinkBiz Portal imposes service fee on top of the total amount to be paid.</p>
                            </div>
                            <hr>
                            <p><span class="badge badge-danger">Please attach supporting documents.</span></p>
                            <p class="text-primary"> Attaching supporting document is <span class="text-danger font-weight-bold">required</span>. A regulation officer will check these documents before processing your request.</p>
                            <div class="file-loading">
                                <input type="file" id="input-100" name="files[]" accept="pdf" multiple hidden>
                            </div>
                            <button class="btn btn-primary float-right" type="button" id="confirm_payment_btn"><i class="fa fa-check"></i>Confirm and Proceed to Payment</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
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
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on('click', '#btnPrint', function() {
            $("#printIframe").get(0).contentWindow.print();
        })

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
                'transaction_types_group' : "{{$response->transaction_types_group}}",
                'payment_method' : "{{$response->payment_method}}",
                @if(!empty($response->volume))
                'volume' : "{{$response->volume}}",
                @endif
                        @if(!empty($response->totalVolume))
                'totalVolume' : "{{$response->totalVolume}}",
                @endif
                'amount' : "{{$response->amount}}"

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
            if(data.response.transaction_code == "PRE" || data.response.transaction_types_group == "LAB"){
                form = $("#premixProductForm");
                formData = form.serialize();
                $.ajax({
                    url : "{{route('dashboard.OOP', 'id')}}".replace('id', id),
                    data: formData,
                    type: 'POST',
                    success: function (res) {
                        window.open("{{route('dashboard.landBank', 'id')}}".replace('id', id), '_blank').focus();
                    },
                    error: function (res) {
                        console.log(res);
                    }
                });
            }
            else {
                window.open("{{route('dashboard.landBank', 'id')}}".replace('id', id), '_blank').focus();
            }
            $("#transaction_id").html(data.response.transaction_id);
            $("#amountToPay").html("Amount to Pay: Php "+ data.response.amount);
            $("#timestamp").html(data.response.timestamp);
            var printRoute = "{{route('printTransaction')}}";
            var newPrintRoute = printRoute + "?transactionId=" + data.response.transaction_id;

            $("#printIframe").attr('src', newPrintRoute)

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
        if($("#input-100")[0].files.length === 0){
            swal({
                title: "Empty!",
                text: "Please upload supporting documents.",
                type: "error"
            });
        }
        else {
            $(this).attr("disabled","disabled");
            icon = $("#confirm_payment_btn i");
            icon.removeClass('fa-check');
            icon.addClass('fa-spinner fa-spin');
            uploader.fileinput('upload');
        }
    })

    $(window).focus(function () {
        console.log('Im focused');
    })
</script>
