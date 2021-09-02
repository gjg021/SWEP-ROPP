<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Landbank LinkBiz Portal</title>
    @include('layouts.css-plugins')
<style>
    body {
        background: #f5f5f5
    }
    .rounded {
        border-radius: 1rem
    }
    .nav-pills .nav-link {
        color: #555
    }
    .nav-pills .nav-link.active {
        color: white
    }
    input[type="radio"] {
        margin-right: 5px
    }
    .bold {
        font-weight: bold
    }
</style>
</head>
<body>
<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Sugar Regulatory Administration</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <h3 class="pb-2 text-xl-center mb-lg-3" style="color: #1499f9">TRANSACTION VERIFICATION</h3>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="20%">Transaction ID</td>
                            <td width="5%">:</td>
                            <td width="75%" style="font-weight: 600" class="font-weight-bold"> {{$response->slug}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Transaction Type</td>
                            <td width="5%">:</td>
                            <td width="75%"style="font-weight: 600" class="font-weight-bold"> {{$response->transaction_type}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Payor</td>
                            <td width="5%">:</td>
                            <td width="75%"style="font-weight: 600" class="font-weight-bold"> {{$user->business_name}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.js-plugins')
</body>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</html>