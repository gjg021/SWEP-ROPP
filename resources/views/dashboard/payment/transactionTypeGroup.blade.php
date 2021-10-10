<div class="form-group m-t-sm">
    <label><strong>Transaction type:</strong></label>
    <select class="form-control form-control-lg" name="transaction_code" id="transaction_type">
        @if(count($transaction_types)> 0)
            <option disabled="" selected>Select</option>
            @foreach($transaction_types as $key => $group)
                <optgroup label="{{$key}}">
                    @foreach($group as $key2 => $trasaction_type)
                        <option transactionCode="{{$trasaction_type['transaction_code']}}" transGroup="{{$trasaction_type['group']}}" value="{{$key2}}" type="{{$trasaction_type['unit']}}" amount="{{$trasaction_type['fee_per_unit']}}" regularFee="{{$trasaction_type['regular_fee']}}" expediteFee="{{$trasaction_type['expedite_fee']}}">{{$trasaction_type['transaction_type']}}</option>
                    @endforeach
                </optgroup>
            @endforeach
        @endif
    </select>
</div>