<div class=''>
    <div class="form-group">
        <label><strong>Lab Analysis:</strong></label>
        <div class="input-group">
            <select multiple="" id="transactionTypesLabAnalysis" name="transactionTypesLabAnalysis" class="form-control select_multiple" size="6">
                @foreach($transaction_types_lab_analysis as $key => $slug)
                    <option id="{{$slug->slug}}" name="{{$slug->slug}}" labName="{{$slug->name}}" value="{{$slug->slug}}" regularFee="{{$slug->regular_fee}}" expediteFee="{{$slug->expedite_fee}}">
                        {{$slug->name}}
                    </option>
                @endforeach
            </select>
            <span class="input-group-append">
                <button type='button' id='addLabAnalysis' style='' class='btn btn-info' onclick='addLabAnalysisToListRegular();'>Regular</button>
                @if(!($iD == "LAB-060" || $iD == "LAB-070"))
                    <button type='button' id='addLabAnalysis' style='' class='btn btn-danger' onclick='addLabAnalysisToListExpedite();'>Expedite</button>
                @endif
            </span>
        </div>
    </div>
</div>
<div class="mb-lg-3">
    <table id="tbTransactionTypesLabAnalysis" class="table">
        <thead>
        <tr>
            <th></th>
            <th>Analysis</th>
            <th>Fee</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>