<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SRA | Transaction Print</title>

    <link href="{{asset('template/inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('template/inspinia/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('template/inspinia/css/style.css')}}" rel="stylesheet">

</head>

<body class="white-bg">
<div class="wrapper wrapper-content p-xl">
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <img alt="image" class="rounded-circle" src="{{asset('images/sra_logo_sm.png')}}"/>
                <h5>From:</h5>
                <address>
                    <strong>Sugar Regulatory Administration</strong><br>
                    Sugar Center Bldg., North Avenue,<br>
                    Diliman, Quezon City<br>
                    <abbr title="Phone">P:</abbr> 09123456789
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Order of Payment No.</h4>
                <h4 class="text-navy">{{$op->slug}}</h4>
                <span>To:</span>
                <address>
                    <strong>{{$client->last_name}}, {{$client->first_name}} {{$client->middle_name}}</strong><br>
                    <strong>{{$client->business_name}}</strong><br>
                    {{$client->business_street}}<br>
                    {{$client->business_barangay}}, {{$client->business_city}}<br>
                    <abbr title="Phone">P:</abbr> {{$client->business_phone}}
                </address>
                <p>
                    <span><strong>Transaction Date:</strong> {{$op->created_at}}</span><br/>
                    <span><strong>Due Date:</strong> {{$op->expires_on}}</span>
                </p>
            </div>
        </div>

        @if(count($opDetails)> 0)
            <div class="table-responsive m-t">
                <table class="table invoice-table">
                    <thead>
                    <tr>
                        <th>Details</th>
                        <th></th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><strong>{{$op->transaction_type}}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($opDetails as $opDetailsView)
                        <tr>
                            <td>{{$opDetailsView->product!=null?$opDetailsView['product']:$opDetailsView['lab_analysis_type']}}</td>
                            @if($opDetailsView->product!=null)
                                <td>{{$opDetailsView['volume']}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{number_format($opDetailsView['amount'],2)}}</td>
                            @if($opDetailsView->product==null)
                                <td>{{$opDetailsView->is_expedite?"EXPEDITE":"REGULAR"}}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /table-responsive -->
            @else
            <div class="table-responsive m-t">
                <table class="table invoice-table">
                    <thead>
                    <tr>
                        <th>Details</th>
                        <th></th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$op->transaction_type}}</td>
                        <td>{{$op->total_volume}}</td>
                        <td>{{number_format($op->total_amount,2)}}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- /table-responsive -->
        @endif

        <table class="table invoice-total">
            <tbody>
            <tr>
                <td><strong>TOTAL :</strong></td>
                <td>PHP {{number_format($op->total_amount,2)}}</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Mainly scripts -->
<script src="{{asset('template/inspinia/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/popper.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/bootstrap.js')}}"></script>
<script src="{{asset('template/inspinia/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('template/inspinia/js/inspinia.js')}}"></script>
</body>
</html>
