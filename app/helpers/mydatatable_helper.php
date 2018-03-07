<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
*  edit_column callback function in Codeigniter (Ignited Datatables)
*
* Grabs a value from the edit_column field for the specified field so you can
* return the desired value.  
*
* @access   public
* @return   mixed
*/

if ( ! function_exists('check_movement'))
{
    function check_movement($status)
    {
    	return $status == 'borrowed' ? 'Out' : 'In';
    }   
}

if ( ! function_exists('productidtoname'))
{
    function productidtoname($id)
    {
    	$CI = get_instance();

	    $CI->load->model('site');

	    $q = $CI->site->getProductByID($id);
    	
    	if ($q == false) {
    		return 'Product Deleted';
        } else {
        	return $q->name.' ['.$q->code.']';
        }
    }   
}

if ( ! function_exists('useridtoname'))
{
    function useridtoname($id)
    {
    	$CI = get_instance();

	    $CI->load->model('site');

	    $q = $CI->site->getUser($id);
    	
    	if ($q == false) {
    		return 'User Deleted';
        } else {
        	return $q->first_name.' ['.$q->last_name.']';
        }
    }   
}

if ( ! function_exists('formatMoneyWithPercentYearLess'))
{
    function formatMoneyWithPercentYearLess($id)
    {
        $CI = get_instance();

        $CI->load->admin_model('products_model');
        
        $q = $CI->products_model->getProductDetail($id);
        
        if ($q == false) {
            return '';
        } else {
            return $CI->sma->formatMoneyWithPercentYearLess($q->price, $q->date_purchased, $q->percentage);
        }
    }   
}