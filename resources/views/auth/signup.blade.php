
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SWEP - Register</title>

    @include('layouts.css-plugins')
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 6px;

        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius:5px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper auth p-0 theme-two">
            <div class="row d-flex align-items-stretch">
                <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
                    <div class="slide-content bg-2"> </div>
                </div>
                <div class="col-12 col-md-8 h-100 bg-white">
                    <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column" style="padding-top: 50px">

                        <form id="register_form" style="overflow-x:hidden; overflow-y:auto">
                            @csrf
                            <h3 class="mr-auto">Register</h3>
                            <p class="mb-5 mr-auto">Enter your details below.</p>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="mdi mdi-account-outline"></i>
                                        </span>
                                            </div>
                                            <input name="email" type="email" class="form-control" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="mdi mdi-lock-outline"></i>
                                    </span>
                                            </div>
                                            <input name="password" type="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="mdi mdi-lock-outline"></i>
                                        </span>
                                            </div>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small class="text-info">Personal Information</small>
                            <hr style="margin-top: 1px">

                            <div class="row">
                                {!! __form::a_textbox( 4,'First Name:*','first_name', 'text', 'First Name','', '')!!}
                                {!! __form::a_textbox( 4,'Middle Name:*','middle_name', 'text', 'Middle Name','', '')!!}
                                {!! __form::a_textbox( 4,'Last Name:*','last_name', 'text', 'Last Name','', '')!!}
                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Sex:*</label>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-radio" style="margin-top: 5px">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="sex" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="M" checked=""> Male <i class="input-helper"></i></label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-radio" style="margin-top: 5px">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="sex" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="F"> Female <i class="input-helper"></i></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {!! __form::a_textbox( 4,'Birthday:*','birthday', 'date', 'Last Name','', '')!!}

                                {!! __form::a_textbox( 4,'Contact number:*','phone', 'text', 'Contact number','', '')!!}
                            </div>
                            <small class="text-info">Business Information</small>
                            <hr style="margin-top: 1px">
                            <div class="row">
                                {!! __form::a_textbox( 6,'Business Name:*','business_name', 'text', 'Business Name','', '')!!}
                                {!! __form::a_textbox( 3,'Business TIN:*','business_tin', 'number', 'Business TIN','', '')!!}
                                {!! __form::a_textbox( 3,'Business Contact Number:*','business_phone', 'number', 'Business Contact Number','', '')!!}
                            </div>
                            <div class="row">
                                {!! __form::a_select('3', 'Region:*', 'region', [], '' , '') !!}
                                {!! __form::a_select('3', 'Province:*', 'province', [], '' , '') !!}
                                {!! __form::a_select('3', 'Municipality/City:*', 'municipality', [], '' , '') !!}
                                {!! __form::a_select('3', 'Barangay:*', 'barangay', [], '' , '') !!}
                            </div>
                            <div class="row">

                                {!! __form::a_textbox( 8,'Detailed address:*','address', 'text', 'Lot, Block, Street','', '')!!}
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary submit-btn float-right"><i class="fa fa-sign-in"></i> REGISTER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('layouts.js-plugins')
</body>

<script type="text/javascript">
    $(document).ready(function(){
        var regions;
        $.getJSON('{{asset("regions.json")}}', function(data){
            regions = data;
            $.each(data, function(i, item){
                $("select[name='region']").append('<option value="'+i+'">'+item.region_name+'</option>');
            })
        })
        html_region = $("select[name='region']");
        html_province = $("select[name='province']");
        html_municipality = $("select[name='municipality']");
        html_barangay = $("select[name='barangay']");

        html_region.change(function(){
            selected = $(this).val();
            html_province.html('<option value="">Select</option>');
            html_municipality.html('<option value="">Select</option>');
            html_barangay.html('<option value="">Select</option>');

            $.each(regions[selected]['province_list'], function(i,item){
                html_province.append('<option value="'+i+'">'+i+'</option>');
            })
        })

        html_province.change(function(){
            selected = $(this).val();
            html_municipality.html('<option value="">Select</option>');
            html_barangay.html('<option value="">Select</option>');

            $.each(regions[html_region.val()]['province_list'][selected]['municipality_list'], function(i,item){
                html_municipality.append('<option value="'+i+'">'+i+'</option>');
            });

        });

        html_municipality.change(function(){
            selected = $(this).val();
            html_barangay.html('<option value="">Select</option>');
            $.each(regions[html_region.val()]['province_list'][html_province.val()]['municipality_list'][selected]['barangay_list'], function(i,item){
                html_barangay.append('<option value="'+item+'">'+item+'</option>');
            })
        })

    })

    $("#register_form").submit(function(e){
        e.preventDefault()
        form = $(this);
        formdata = form.serialize();
        loading_btn(form);
        $.ajax({
            url: '{{route("auth.signup")}}',
            type:'POST',
            data: formdata,
            success: function(response){
                if(response == 1){
                    remove_loading_btn(form);
                    //$("#sign_up_modal").modal('hide');
                    $.confirm({
                        title: 'Email Verification Sent!',
                        icon: 'fa fa-envelope',
                        type: 'green',
                        content: 'A link was sent to your email address. Please click that link to activate your account.',
                        buttons: {
                            OK: {
                                text: 'OK',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    $("#sign_up_modal .modal-footer").hide();
                                    $("#sign_up_modal .modal-title").hide();
                                    $(".wizard-container").slideDown();
                                    $(".form-container").slideUp();
                                }
                            }
                        }
                    });
                }
            },
            error: function(response){
                errored(form,response);
            }
        })
    })
</script>
</html>