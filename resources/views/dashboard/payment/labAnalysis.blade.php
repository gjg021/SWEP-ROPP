<div class='form-group'>
    <label>Product</label>
    <div class="input-group">
        <select class='form-control form-control-lg' name='LabAnalysisName' id='LabAnalysis'>
            <option disabled='' selected>--Please select--</option>
            @if(count($lab_analysis)> 0)
            @foreach($lab_analysis as $key1 => $slug)
            <option onclick='changeProduct({{$slug['sucrose']}});' id='{{$key1}}' name='{{$slug['product_description']}}' value='{{$key1}}' sucrose='{{$slug['sucrose']}}'>{{$slug['product_description']}}</option>
            @endforeach
            @endif
            </select>
        <span class="input-group-append">
                <button type='button' id='addProduct' style='' class='btn btn-info' onclick='addProductToList();'><i class='fa fa-plus-circle' ></i></button>
        </span>
    </div>
</div>
