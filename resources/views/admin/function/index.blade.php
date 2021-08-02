@extends('admin-layouts.modal-content')

@section('modal-header')
  {{$menu->menu_name}} | {{$menu->route}}
@endsection


@section('modal-body')
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <div class="col-md-6">
          {{$menu->menu_name}} Functions
        </div>
        <div class="col-md-6">
          <div class="btn-group pull-right">
            <button class="btn btn-success btn-sm add_resource_btn" route="{{$menu->route}}" data="{{$menu->slug}}">
              <i class="fa  fa-tasks"></i>
              Add resource
            </button>
            <button class=" btn btn-primary btn-sm" data-toggle="modal" data-target="#add_function_modal"><i class="fa fa-plus"> </i> Add new function</button>
            
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
        <img src="{{ asset('images/load_anim.gif') }}">
      </div>
      <div id="functions_table_container" hidden="">
        <table class="table table-bordered table-condensed table-striped" id = "functions_table" style="width: 100%">
          <thead>
            <tr>
              <th>Function Name</th>
              <th>Route</th>
              <th>Label</th>
              <th>Icon</th>
              <th>Nav</th>
              <th>Belongs to</th>
              <th style="width: 100px">Action</th>
            </tr>
          </thead>
          <tbody>


          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection


@section('modal-footer')
  
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

@endsection

@section('scripts')
  
<script type="text/javascript">
  $(document).ready(function(){
    function_active = '';
    functions_tbl =  $("#functions_table").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax" : '{{ route("admin.functions.index") }}?type=dataTable&menu_slug={{$menu->slug}}',
      "columns": [
        { "data": "function_name" },
        { "data": "function_route" },
        { "data": "function_label" },
        { "data": "function_icon" },
        { "data": "function_is_nav" },
        { "data": "function_belongs_to" },
        { "data": "action" },

      ],
          // buttons: [
          //     'copy', 'excel', 'pdf'
          // ],
          "columnDefs":[
          {
            "targets" : 0,
            "visible" : true
          },
          {
            "targets" : 0,
            "orderable" : false,
            "class" : 'action-3'
          },
          {
            "targets": 3, 
            // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
          }
          ],
          "order" : [[0, 'asc']],
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#functions_index_modal #tbl_loader').fadeOut(function(){
              $("#functions_table_container").fadeIn();
            });
            dt_press_enter('#functions_table_filter',functions_tbl);
          },
          "language": 
          {          
            "processing": "<center><img style='width: 70px' src=''></center>",
          },
          "drawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();
            
            if(function_active != ''){
             $("#functions_table #"+function_active).addClass('success');
           }
         }
       });
  })
</script>

@endsection
