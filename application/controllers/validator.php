<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Validator extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('mydb');
        
        $this->load->library('form_validation');
    }
    
    function _greater_than_equals($str, $val) {
        $this->form_validation->set_message('_greater_than_equals', '%s tidak boleh kurang dari %s.');
        if (!is_numeric($str)) return false;
        return $str >= $val;
    }
    
    function _less_than_equals($str, $val) {
        $this->form_validation->set_message('_less_than_equals', '%s tidak boleh lebih dari %s.');
        if (!is_numeric($str)) return false;
        return $str <= $val;
    }
    
    function _valid_date($str) {
        // dd/mm/yyyy
        $this->form_validation->set_message('_valid_date', '%s harus ditulis dengan format dd/mm/yyyy.');
        if (preg_match("/^(0[0-9]|[12][0-9]|3[01])\/(0[0-9]|1[012])\/(19|20|00)\d\d/", $str))
            return true;
        return false;
    }
    
}
?>
