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

if ( ! function_exists('computeReturnDelay'))
{
    function computeReturnDelay($pb_id)
    {
        $CI = get_instance();

        $CI->load->model('site');
        
        $q = $CI->site->getBorrowedByID($pb_id);

        if ($q == false) {
            return '';
        } else {
            
            $return_date = $q->return_date;
            $actual_return_date = $q->actual_return_date;

            if($actual_return_date == '0000-00-00 00:00:00') {
                return '';
            }

            $return_date = DateTime::createFromFormat("Y-m-d H:i:s", $return_date);
            $actual_return_date = DateTime::createFromFormat("Y-m-d H:i:s", $actual_return_date);

            $return_date = $return_date->getTimestamp();     
            $actual_return_date = $actual_return_date->getTimestamp();     
            
            if($return_date == $actual_return_date || $return_date > $actual_return_date) {
                return '';
            }

            return timespan($return_date, $actual_return_date) . ' ago';   
        }
    }
}

if ( ! function_exists('computeTimeConsumed'))
{
    function computeTimeConsumed($pb_id)
    {
        $CI = get_instance();

        $CI->load->model('site');
        
        $q = $CI->site->getBorrowedByID($pb_id);

        if ($q == false) {
            return '';
        } else {
            
            $borrowed_date = $q->borrowed_date;
            $actual_return_date = $q->actual_return_date;

            if($actual_return_date == '0000-00-00 00:00:00') {
                return '';
            }

            $borrowed_date = DateTime::createFromFormat("Y-m-d H:i:s", $borrowed_date);
            $actual_return_date = DateTime::createFromFormat("Y-m-d H:i:s", $actual_return_date);

            $borrowed_date = $borrowed_date->getTimestamp();     
            $actual_return_date = $actual_return_date->getTimestamp();     
            
            return timespan($borrowed_date, $actual_return_date) . ' ago';   
        }
    }
}   