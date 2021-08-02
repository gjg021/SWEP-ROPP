<?php

namespace App\Core\ViewHelpers;

use App\Core\Helpers\__sanitize;
use App\Core\Helpers\__dataType;


class __form{



    /** Default **/
    public static function textbox($class, $key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <input class="form-control" id="'. $key .'" name="'. $key .'" type="'. $type .'" value="'. self::string_value($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function textbox_numeric($class, $key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <input class="form-control priceformat" id="'. $key .'" name="'. $key .'" type="'. $type .'" value="'. __sanitize::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                  '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function select_dynamic($class, $key, $label, $old_value, $array, $var1, $var2, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                </select>
                '. self::error_message($error_has, $error_first) .'
              </div>';
                
    }



    public static function select_static($class, $key, $label, $old_value, $array, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
                '. self::error_message($error_has, $error_first) .'
              </div>';
                
    }



    public static function textarea($class, $key, $label, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <textarea id="editor" name="'. $key .'" rows="10" cols="80" '. $extra_attr .'>'. __sanitize::html_encode($old_value) .'</textarea>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function datepicker($class, $key, $label, $old_value, $error_has, $error_first){

       $old_value = __dataType::date_parse($old_value, 'm/d/Y');

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'" style="overflow:hidden;">
                <label for="'. $key .'">'. $label .'</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="'. $key .'" name="'. $key .'" value="'. __sanitize::html_attribute_encode($old_value) .'" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                </div>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function timepicker($class, $key, $label, $old_value, $error_has, $error_first){

       return '<div class="col-md-'. $class .' bootstrap-timepicker">
                <div class="form-group '. self::error_response($error_has) .'">
                  <label>'. $label .'</label>
                  <div class="input-group">
                    <input id="'. $key .'" name="'. $key .'" value="'. __sanitize::html_attribute_encode($old_value) .'" type="text" class="form-control timepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  '. self::error_message($error_has, $error_first) .'
                </div>
              </div>';

    }



    public static function file($class, $key, $label, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <div class="file-loading">
                  <input class="file" name="'. $key .'" id="'. $key .'" type="file" '. $extra_attr .'>
                </div>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }




    /** Inlines **/
    public static function textbox_inline($key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="'. $type .'" value="'. __sanitize::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                </div>';

    }



    public static function password_inline($key, $label, $placeholder, $error_has, $error_first, $extra_attr){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="password" placeholder="'. $placeholder .'" '. $extra_attr .'>
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                  <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="show_'. $key .'" id="show_'. $key .'" type="checkbox"> Show
                        </label>
                    </div>
                  </div>
                </div>';
                
    }



    public static function select_dynamic_inline($key, $label, $old_value, $array, $var1, $var2, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group '. self::error_response($error_has) .'">
                <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                <div class="col-sm-10">
                  <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .'>
                    <option value="">Select</option>
                    '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                  </select>
                  '. self::error_message($error_has, $error_first) .'
                </div>
              </div>';
                
    }





    /** For Filters **/

    public static function select_static_for_filter($class, $key, $label, $old_value, $array, $form, $select2, $extra_attr){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control input-md '. $select2 .'" onchange="document.getElementById('. $string .''. $form .''. $string .').click()" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
              </div>';
                
    }




    public static function select_dynamic_for_filter($class, $key, $label, $old_value, $array, $var1, $var2, $form, $select2, $extra_attr){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control input-md '. $select2 .'" onchange="document.getElementById('. $string .''. $form .''. $string .').click()" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                </select>
              </div>';
                
    }
    




    /** For Dynamic Tables **/

    public static function textbox_for_dt($name, $placeholder, $value, $error_first){

       return '<div class="form-group">
                  <input type="text" name="'. $name .'" class="form-control" placeholder="'. $placeholder .'" value="'. __sanitize::html_attribute_encode($value) .'">
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    public static function textbox_numeric_for_dt($name, $placeholder, $value, $error_first){

       return '<div class="form-group">
                  <input type="text" name="'. $name .'" class="form-control priceformat" placeholder="'. $placeholder .'" value="'. __sanitize::html_attribute_encode($value) .'">
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    public static function datepicker_for_dt($name, $value, $error_first){

       $value = __dataType::date_parse($value, 'm/d/Y');

       return '<div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input name="'. $name .'" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="'. __sanitize::html_attribute_encode($value) .'">
                  </div>
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    public static function select_static_for_dt($name, $array, $value, $error_first){

       return '<div class="form-group">
                  <select name="'. $name .'" class="form-control">
                    <option value="">Select</option>
                    '. self::static_options($array, $value) .'
                  </select>
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    /** UTILITY METHODS **/ 


    public static function string_value($value){

        $value = isset($value) ? $value : '';
        return __sanitize::html_attribute_encode($value);

    }


    public static function error_response($error_has){

      return $error_has ? 'has-error' : '';

    }



    public static function error_message($error_has, $error_first){

      if($error_has){

        return '<p class="help-block"> '. $error_first .' </p>';

      }

    }



    public static function static_options($array, $old_value){

      $string = '';

      foreach($array as $item => $value){

        $condition = $value == $old_value ? 'selected' : '';

        $string .= '<option value="'. $value .'" '. $condition .'>'. $item .'</option>';

      }

      return $string;

    }



    public static function dynamic_options($array, $var1, $var2, $old_value){

      $string = '';

      foreach($array as $value){

        $condition = $value->$var1 == $old_value ? 'selected' : '';
        
        $string .= '<option value="'. $value->$var1 .'" '. $condition .'>'. $value->$var2 .'</option>';

      }

      return $string;

    }

    // New Form Helpers

    public static function a_textbox($length, $label, $name, $type , $placeholder , $value, $attr, $class = null ){

      if($class != null){
        $fg_class = "fg-".$class;
        $input_class = "input-".$class;
      }else{
        $fg_class = '';
        $input_class = '';
      }
      return '<div class="form-group col-md-'.$length.' '.$fg_class.'" id="fg-'.$name.'">
                <label for="'.$name.'">'.$label.'</label>
                <input class="form-control '.$input_class.'" id="'.$name.'" name="'.$name.'" type="'.$type.'" value="'.$value.'" placeholder="'.$placeholder.'" '.$attr.'>
              </div>';
    }

    public static function a_select($length, $label, $name, $array , $value, $attr, $class = null ){
      if($class != null){
        $fg_class = "fg-".$class;
        $input_class = "input-".$class;
      }else{
        $fg_class = '';
        $input_class = '';
      }

      $options = '';
      foreach ($array as $option => $val) {
        if($value === $val){
          $options = $options.'<option value="'.$val.'" selected>'.$option.'</option>';
        }else{
          $options = $options.'<option value="'.$val.'">'.$option.'</option>';
        }
      }

      return '<div class="form-group col-md-'.$length.' '.$fg_class.'" id="fg-'.$name.'">
        <label for="is_menu">'.$label.'</label>
        <select name="'.$name.'" class="form-control '.$input_class.'" '.$attr.'">
          <option value="">Select</option>
          '.$options.'
        </select>  
      </div>';
    }


}