<div class='form-group'>
    <label>Lab Analysis:</label>
    <div class="input-group">
        <select multiple="" id="transactionTypesLabAnalysis[]" name="transactionTypesLabAnalysis[]" class="form-control select_multiple" size="6">
            <option value="ALL" selected>----- ALL -----</option>
            @foreach($transaction_types_lab_analysis as $key => $slug)
                    <option value="{{$slug->slug}}" menu="">
                        {{$slug->name}}
                    </option>
            @endforeach
        </select>
        <span class="help-block">
        </span>
    </div>
</div>