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

function notify_custom(message, type, heading = 'Info'){
    $.toast({
        heading: heading,
        text: message,
        showHideTransition: 'slide',
        icon: type,
        loaderBg: '#46c35f',
        position: 'top-right'
    })
}


//This puts error on the form input
function put_errors(target_form, response){


    $('#'+target_form.attr('id')+' .has-danger').each(function(){
        $(this).removeClass('has-danger');
        $(this).children('.help-block').remove();
    });

    $.each(response.responseJSON.errors, function(i, item){

        target = $("#"+target_form.attr('id')+" .form-control[name='"+i+"']").parents('.form-group');
        target.addClass('has-danger');
        target.append('<span class="help-block" style="margin-bottom:0px"> <small>'+item+'</small></span>');
    });

    notify_custom('Please fill out the required fields.','warning');
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