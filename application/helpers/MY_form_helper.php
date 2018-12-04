<?php 

    defined('BASEPATH') OR exit('No direct script access allowed');

    if ( ! function_exists('form_date')) {
        function form_date($data = "", $value = "", $extra = "") {
            $defaults = array('type' => 'date', 'name' => (( ! is_array($data)) ? $data : ""), 'value' => $value);
            return "<input "._parse_form_attributes($data, $defaults).$extra." />";
        }
    }

    if ( ! function_exists('form_number')) {
        function form_number($data = "", $value = "", $extra = "") {
            $defaults = array('type' => 'number', 'name' => (( ! is_array($data)) ? $data : ""), 'value' => $value);
            return "<input "._parse_form_attributes($data, $defaults).$extra." />";
        }
    }
    
?>
