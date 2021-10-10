<div class="col-md-12">
    <div class="col-md-3">
        <div style="display: flex; width: 150px; height: 150px; margin: auto;border-radius:50%">
            <img  width="200px" height="150px" style="object-fit: cover;overflow: hidden;" src="{{asset('images/sra_logo_sm.png')}}" class="img-thumbnail img-circle" alt="payment.getUser().getName(true, true, true">
        </div>
    </div>
    <div class="col-md-9">
        <h2 class="no-margins" style="font-weight:800;">
            {{$user->last_name}}, {{$user->first_name}} {{$user->middle_name}} ---- {{$user->business_name}}
        </h2>
        <h3>
            <i class="fa fa-user"></i>&nbsp;{{$user->slug}} &nbsp;&nbsp;<br>
            <i class="fa fa-map-marker"></i>&nbsp;{{$user->street}}
        </h3>
        <a data-toggle="modal" class="btn btn-primary btn-rounded addLab" data="{{$user->slug}}" data-tagret="#addModal" data-placement="top"><i class="fa fa-plus"></i>&nbsp;Add</a>
    </div>

    <div class="col-md-12" style="margin-top: 20px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Analysis Record
            </div>
            <div class="panel-body">
                <div class="row">
                    <table id="tbClientLab" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Report No.</th>
                                <th>Sample No.</th>
                                <th>Date Received</th>
                                <th>Date Analyze</th>
                                <th>Parameter</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($labAnalysis as $key => $slug)
                            <tr id="{{$slug->slug}}">
                                <td>{{$slug->slug}}</td>
                                <td>{{$slug->product_description}}</td>
                                <td>{{$slug->report_no}}</td>
                                <td>{{$slug->sample_no}}</td>
                                <td>{{$slug->date_received}}</td>
                                <td>{{$slug->date_analyzed}}</td>
                                <td>{{$slug->parameter}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
