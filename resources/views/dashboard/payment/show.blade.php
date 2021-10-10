<div class="modal-header">
    <h5 class="modal-title"><code>{{$op->slug}}</code></h5>
</div>
<div class="modal-body">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                    <i class="fa fa-list-ul icon-sm my-1 mx-1"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted"> Transaction Type</p>
                    <h6 class="font-weight-semibold mb-0 text-info">{{$op->transaction_type}}</h6>
                </div>
            </div>
            <div class="col d-flex">
                <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                    <i class="fa fa-credit-card icon-sm my-1 mx-1"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted">Payment Method</p>
                    <h6 class="font-weight-semibold mb-0 text-info">{{$op->payment_method}}</h6>
                </div>
            </div>
            <div class="col d-flex">
                <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                    <i class="fa fa-ruble icon-sm my-1 mx-2"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted">Amount</p>
                    <h6 class="font-weight-semibold mb-0 text-info">{{number_format($op->total_amount,2)}}</h6>
                </div>
            </div>
            <div class="col d-flex">
                <div class="d-inline-flex align-items-center justify-content-center border rounded-circle px-2 py-2 my-auto text-muted">
                    <i class="fa fa-clock-o icon-sm my-1 mx-1"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted">Status</p>
                    <h6 class="font-weight-semibold mb-0 text-primary">To Pay</h6>
                </div>
            </div>

            <div class="col-md-12 mt-lg-5">
                @if(count($opDetails)> 0)
                    <div id="orderOfPaymentsTableContainer">
                        <table class="table table-bordered table-condensed table-striped" id = "orderOfPaymentsTable" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Details</th>
                                <th></th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($opDetails as $opDetailsView)
                                <tr>
                                    <td>{{$opDetailsView->product!=null?$opDetailsView['product']:$opDetailsView['lab_analysis_type']}}</td>
                                    @if($opDetailsView->product!=null)
                                        <td>{{$opDetailsView['volume']}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{$opDetailsView['amount']}}</td>
                                    @if($opDetailsView->product==null)
                                        <td>{{$opDetailsView->is_expedite?"EXPEDITE":"REGULAR"}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            @endif
        </div>
    <div class="col-md-12 mt-lg-5"></div>
        <hr>
        <p><i class="fa fa-paperclip"></i> {{$op->supportingDocuments->count()}} Attachment(s)</p>
        <div class="row">
            @if($op->supportingDocuments->count() > 0)
                @foreach($op->supportingDocuments as $supporting_document)
                    <div class="col-md-4">
                        <div class="card rounded mb-2">
                            <div class="card-body p-3">
                                <div class="media">
                                    <div class="align-self-center mr-3">
                                        <div class="text-center" >
                                            <i class="fa fa-file-pdf-o icon-sm text-muted" style="font-size: 1.8rem"></i>
                                        </div>
                                        <div class="badge badge-outline-danger badge-pill">PDF</div>
                                    </div>
                                    <div class="media-body">
                                        <div style="height: 50px">
                                            <h6 class="mb-1">
                                                @php
                                                    $str_to_show = substr($supporting_document->path, strpos($supporting_document->path, "]") + 2);
                                                    if(strlen($str_to_show) > 75){
                                                        echo substr($str_to_show,0,76).'...';
                                                    }else{
                                                        echo $str_to_show;
                                                    }
                                                @endphp

                                            </h6>
                                        </div>
                                        <div>

                                            @if(Storage::disk('local')->exists($supporting_document->path))
                                                <small class="text-muted">
                                                    {{round(Storage::disk('local')->size($supporting_document->path)/1000000,2)}} mb
                                                </small>

                                                <a href="{{route('dashboard.payments.view_file')}}?file={{$supporting_document->id}}" target="_blank" class="btn btn-xs btn-primary float-right" style="padding-top: 3px; padding-bottom: 3px; color: white; font-size: x-small">View</a>
                                            @else
                                                <small class="text-danger">
                                                    <i class="fa fa-warning"></i> File not Found
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
</div>