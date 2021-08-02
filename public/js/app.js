

// LOADER
$('#loader')
    .hide() 
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    })
;



// SELECT2 Caller
$('.select2').select2();



// SELECT2 Multiple
$('select[multiple]').select2({
    closeOnSelect: false,
});


// Filter Form Submit Rule
$(document).ready(function($){
   $("#filter_form").submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true;
    });
    $("form").find( ":input" ).prop( "disabled", false );
});



// Price Format
$(".priceformat").priceFormat({
    prefix: "",
    thousandsSeparator: ",",
    clearOnEmpty: true,
    allowNegative: true
});



// Input to Uppercase
$(document).on('blur', "input[data-transform=uppercase]", function () {
    $(this).val(function (_, val) {
        return val.toUpperCase();
    });
});



// iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
});



// Date Picker
$('.datepicker').each(function(){
    $(this).datepicker({
        autoclose: true,
        dateFormat: "mm/dd/yy",
        orientation: "bottom"
    });
});



// Time Picker
$('.timepicker').timepicker({
  showInputs: false,
  minuteStep: 1,
  showMeridian: true,
});



// Table Rule
$(document).on('change', 'select[id="action"]', function () {
  var element = $(this).children('option:selected');
  if(element.data('type') == '1' ){ 
    location = element.data('url');
  }
});


// Delete row in Dynamic Table
$(document).on("click","#delete_row" ,function(e) {
    $(this).closest('tr').remove();
});



// PJAX Form Caller
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container');
});



// PJAX Link Caller
$(document).pjax('a[data-pjax]', '#pjax-container');




// PJAX INITIALIZATIONS
$(document).on('ready pjax:success', function() {
    

    // Filter Form Submit Rule
    $(document).ready(function($){
       $("#filter_form").submit(function() {
            $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
            return true;
        });
        $("form").find( ":input" ).prop( "disabled", false );
    });


    // Price Format
    $(".priceformat").priceFormat({
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: true
    });


    // Text to Upper Case
    $(document).on('blur', "input[data-transform=uppercase]", function () {
        $(this).val(function (_, val) {
            return val.toUpperCase();
        });
    });


    // Select2
    $('.select2').select2();


    // Datepicker
    $('.datepicker').each(function(){
        $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
    });


});


function notify(message, type){
    $.notify(
        {
            message: message,

        },
        {   
            type: type,
            z_index: 30000,
            animate: {
                enter: 'animate__animated animate__jackInTheBox',
                exit: 'animated fadeOutUp'
            },
        }
    );
}

function notify_saved(){
    $.notify(
        {
            message: 'Data successfully saved!',

        },
        {   
            type: 'success',
            z_index: 30000,
            animate: {
                enter: 'animate__animated animate__jackInTheBox',
                exit: 'animated fadeOutUp'
            },
        }
    );
}

function notify_custom(message, type){
    $.notify(
        {
            message: message,

        },
        {   
            type: type,
            z_index: 30000,
            animate: {
                enter: 'animate__animated animate__jackInTheBox',
                exit: 'animated fadeOutUp'
            },
        }
    );
}


//This puts error on the form input
function put_errors(target_form, response){


    $('#'+target_form.attr('id')+' .has-error').each(function(){
        $(this).removeClass('has-error');
        $(this).children('.help-block').remove();
    });

    $.each(response.responseJSON.errors, function(i, item){
        target = $('#'+target_form.attr('id')+" #fg-"+i);
        target.addClass('has-error');
        target.append('<span class="help-block" style="margin-bottom:0px">'+item+'</span>');
    });

     $.notify(
        {
            message: 'Please fill out the required fields.',

        },
        {   
            type: 'warning',
            z_index: 30000,
            animate: {
                enter: 'animate__animated animate__jackInTheBox',
                exit: 'animated fadeOutUp'
            },
        }
    );
}

function remove_errors(target_form){

    $(target_form+' .has-error').each(function(){
        $(this).removeClass('has-error');
        $(this).children('.help-block').remove();
    });
}


function dt_press_enter(element, datatable){
    $(element+' input').unbind();
    $(element+' input').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            datatable.search(this.value).draw();
        }
    });
}

function errored(target_form,response){
    if(response.status == 422){
        put_errors(target_form,response);
    }
    if(response.status == 500){
        console.log(response);
        notify_custom(response.status+' | '+response.statusText+": "+response.responseJSON.message,'error')
    }
    if(response.status == 404){
        console.log(response);
        notify_custom('Page does not exist or you are not allowed to make this action', 'danger');
    }

    remove_loading_btn(target_form);
}

function succeed(target_form, reset, close_modal){
    notify_saved();
    remove_errors('#'+form.attr('id'));

    if(reset == true){
        form.get(0).reset();
    }

    if(close_modal == true){
        modal = form.parent('div').parent('div').parent(".modal");
        modal.modal('hide');
    }

    remove_loading_btn(target_form);
}

function delete_item(route_uri, btn, datatable){
    table_id = datatable.tables().nodes().to$().attr('id');
    slug = btn.attr('data');
    $("#"+table_id+" #"+slug).addClass('danger');
    uri = route_uri.replace('slugg',slug);
        $.confirm({
            title: 'Confirm to DELETE',
            content: "Are you sure you want to DELETE this item? This can't be undone",
            type: 'red',
            typeAnimated: true,
            icon: 'fa fa-warning',
            buttons: {
                delete: {
                    text: '<i class="fa fa-trash"></i> DELETE',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            url: uri,
                            type:'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                            success: function(response){
                                if(response == true){
                                    notify_custom("Item deleted successfully",'success');
                                    datatable.draw();
                                }
                            },
                            error: function(response){
                                if(response.status == 404){
                                    notify_custom('Page does not exist or you are not allowed to make this action', 'danger');
                                }else{
                                    notify_custom('Unable to delete the item.', 'danger');
                                }
                                
                   
                            }
                        })
                    }
                },
                close: function () {
                    $("#menus_table #"+slug).removeClass('danger');
                }
            }
        });
}

function loading_btn(form){
    prev_class = $("#"+form.attr('id')+" button[type='submit'] i").attr('class');
    $("#"+form.attr('id')+" button[type='submit'] i").attr('class','fa fa-spinner fa-spin');
    $("#"+form.attr('id')+" button[type='submit'] i").attr('prev_class',prev_class);
    $("#"+form.attr('id')+" button[type='submit']").attr('disabled','');

}

function remove_loading_btn(form){
    prev_class = $("#"+form.attr('id')+" button[type='submit'] i").attr('prev_class');
    $("#"+form.attr('id')+" button[type='submit'] i").attr('class',prev_class);
    $("#"+form.attr('id')+" button[type='submit']").removeAttr('disabled');
}


function loading_modal(button){
    modal_id = button.attr('data-target');
    $(modal_id+" .modal-content").html(modal_loader);
}


function populate_modal(button,response){
    modal_id = button.attr('data-target');
    $(modal_id+" .loader").fadeOut(function(){
        $(modal_id+" .modal-content").html(response);
    });
}

function errored_modal(button,response){
    modal_id = button.attr('data-target');
    $(modal_id+" .loader").fadeOut(function(){
        $(modal_id+" .modal-content").html($(".modal-404").html());
    });
}