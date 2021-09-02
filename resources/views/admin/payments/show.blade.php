<div class="modal-header">
    <h3 class="modal-title"><code>{{$op->slug}}</code></h3>
</div>
<div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <p class="mb-0 font-weight-medium text-muted"> Client</p>
                    <h4 class="font-weight-semibold mb-0 text-info">{{$user->business_name}}</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <p class="mb-0 font-weight-medium text-muted"> Transaction Type</p>
                    <h4 class="font-weight-semibold mb-0 text-info">{{$op->transaction_type}}</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <p class="mb-0 font-weight-medium text-muted">Payment Method</p>
                    <h4 class="font-weight-semibold mb-0 text-info">{{$op->payment_method}}</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <p class="mb-0 font-weight-medium text-muted">Amount</p>
                    <h4 class="font-weight-semibold mb-0 text-info">{{number_format($op->total_amount,2)}}</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <p class="mb-0 font-weight-medium text-muted">Status</p>
                    <h4 class="font-weight-semibold mb-0 text-primary">{{$op->status}}</h4>
                </div>
            </div>
        </div>
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
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>
