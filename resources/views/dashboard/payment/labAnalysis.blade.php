<div class='form-group'>
    <label><strong>Product:</strong></label>
    <div class="input-group">
        <select class='form-control form-control-lg' name='LabAnalysisName' id='LabAnalysis'>
            <option disabled='' selected>--Please select--</option>
            @if(count($lab_analysis)> 0)
            @foreach($lab_analysis as $key1 => $slug)
            <option id='{{$key1}}' name='{{$slug['product_description']}}' value='{{$key1}}' sucrose='{{$slug['sucrose']}}'>{{$slug['product_description']}}</option>
            @endforeach
            @endif
            </select>
    </div>
</div>
