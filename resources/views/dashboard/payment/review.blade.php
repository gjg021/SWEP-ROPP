
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
                        <h5 id="timestamp"></h5>
                        <img  width="600" src="{{asset('images/payment.gif')}}" style="margin-bottom: 30px">
                        <h4>We are redirecting you to the {{$response->payment_method}}</h4>
                    </div>
                    <div id="content">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <h4> Payment</h4>

                                <table class="table mt-5 mb-5">
                                    <tbody>

                                    <tr>
                                        <td>Transaction Type:</td>
                                        <td>{{$response->transaction_type}}</td>
                                    </tr>
                                    @if(!empty($response->volume))
                                        <tr>
                                            <td>Volume:</td>
                                            <td>{{$response->volume}} Lkg/tc</td>
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
            $("#transaction_id").html(data.response.transaction_id);
            $("#timestamp").html(data.response.timestamp);
            setTimeout(function(){
                $("#done").slideDown();
                $("#content").slideUp();
            },500);
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
