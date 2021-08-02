<?php

namespace App\Core\ViewHelpers;

use URL;
use Input;
use App\Core\Helpers\__sanitize;

class __html{



    public static function modal($id, $header, $message){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			      <div class="modal-dialog">
			        <div class="modal-content">
			          <div class="modal-header">
			            <button class="close" data-dismiss="modal">
			              <span aria-hidden="true">&times;</span>
			            </button>
			            <h4 class="modal-title">'. $header .'</h4>

			          </div>
			          <div class="modal-body">
			            <p style="font-size: 17px;">'. $message .'</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			          </div>
			        </div>
			      </div>
			    </div>';
			    
    }



    public static function modal_delete($id){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button class="close" data-dismiss="modal">
			            <span aria-hidden="true">&times;</span>
			          </button>
			          <h4 class="modal-title"><i class="fa fa-exclamation-circle "></i> Delete ?</h4>
			        </div>
			        <div class="modal-body" id="delete_body">
			          <form method="POST" id="form">
			            '. csrf_field() .'
			            <input name="_method" value="DELETE" type="hidden">
			            <p style="font-size: 17px;">Are you sure, you want to delete this record?</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-default" data-dismiss="modal">Close</button>
			            <button type="submit" class="btn btn-danger">Delete</button>
			          </form>
			        </div>
			      </div>
			    </div>
			  </div>';
			    
    }




    public static function modal_print($id, $header, $message, $print_route){

       return '<div class="modal fade" id="'. $id .'">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span></button>
			          <h4 class="modal-title">'. $header .'</h4>
			        </div>
			        <div class="modal-body">
			          <p><p style="font-size: 17px;">'. $message .'</p></p>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			          <a href="'. $print_route .'" type="button" class="btn btn-success">Print</a>
			        </div>
			      </div>
			    </div>
			  </div>';
			    
    }




    public static function alert($type, $header, $message){

       return '<div class="alert alert-'. $type .' alert-dismissible">
	              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	              <h4>'. $header .'</h4>
	              '. $message .'
	            </div>';

    }
    



    /** Wrappers **/
    public static function table_search($refresh_route){

    	$string = "'";

    	$seach_button_id = 'table_search_button';

     	$option_50 = Input::old('e') == '50' ? 'selected' : '';
     	$option_100 = Input::old('e') == '100' ? 'selected' : '';

       	return '<div class="box-title">  
	                <div class="input-group input-group-md" style="width: 450px;">
	                  <input name="q" class="form-control pull-right" placeholder="Search any.." type="text" value="'. __sanitize::html_attribute_encode(old("q")) .'">
	                  <div class="input-group-btn">
	                    <button  id="'. $seach_button_id .'" type="submit" class="btn btn-default btn-md"><i class="fa fa-search"></i></button>
	                    <a href="'. $refresh_route .'" class="btn btn-default btn-md">
	                    	Refresh <i class="fa fa-refresh"></i>
	                    </a>
	                  </div>
	                </div>
                </div>

	          	<div class="box-tools" style="margin-top:6px;">
	              	<div class="col-md-4" style="margin-top:6px;">
	              		Entries:
	              	</div>
	              	<div class="col-md-8">
				        <select id="e" class="form-control input-sm" name="e" onchange="document.getElementById('.$string.''. $seach_button_id .''.$string.').click()">
				          <option value="">20</option>
				          <option value="50" '. $option_50 .'>50</option>
				          <option value="100" '. $option_100 .'>100</option>
				        </select>
	              	</div>
	            </div>';

    }




    public static function table_highlighter($slug, $sessions = []){

       foreach($sessions as $data){
       		if($slug == $data){
       			return 'style="background-color: #D5F5E3;"';
       		}
    	}

    }





    public static function table_counter($obj){

    	$first_item = $obj->firstItem() > 0 ? $obj->firstItem() : 0;
    	$last_item = $obj->lastItem() > 0 ? $obj->lastItem() : 0;

        return '<strong>Displaying '. $first_item .' - '.  $last_item .' out of '. $obj->total() .' Records</strong>';

    }





    public static function filter_open(){

       return '<div class="box '. self::collapsed_filter() .'">
		            <div class="box-header with-border" data-widget="collapse">
		                <h3 class="box-title">Advance Filters</h3>
		                <div class="box-tools pull-right">
		                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                </div> 
		            </div>
		            <div class="box-body">';

    }



    public static function filter_close($id){

       return '</div>
            <button type="submit" id="'. $id .'" style="display:none;">Filter</button>
        </div>';

    }



    public static function back_button($route = []){

    	foreach($route as $data){
	    	if(self::previous_route() == $data){
	        	return '<a href="'. URL::previous() .'" class="btn btn-sm btn-default"><i class="fa fa-fw fa-arrow-left"></i>Back</a>';
	    	}
    	}


     }




    /** UTILITY METHODS **/
    public static function collapsed_filter(){

       return Input::except('q', 'page', 'sort', 'direction') ? '' : 'collapsed-box';

    }



    public static function previous_route(){

       return app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

    }


    public static function blank_modal($id, $size,$attr = ''){
    	$img = asset('images/load_anim.gif');
		 return '<div class="modal fade" id="'.$id.'" tabindex="-1" >
			  <div class="modal-dialog modal-'.$size.'" '.$attr.'>
			    <div class="modal-content">
			    </div>
			  </div>
			</div>';
    }

    public static function modal_loader(){
    	$img = asset('images/load_anim.gif');
    	return '<div class="loader_container" hidden><div class="loader">
			      	<img src="'.$img.'">
			      </div></div>';
    }




}