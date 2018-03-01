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