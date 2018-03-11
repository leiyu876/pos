
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	function __construct($config)
  	{
    	parent::__construct($config);
  	}

	public function valid_date($date)
	{
		if($date == '') return true;

		$this->CI->form_validation->set_message('valid_date', 'The %s field must be a valid date. Please use this format( dd/mm/yyyy hh:mm )');

	    $d = DateTime::createFromFormat('d/m/Y H:i', $date);
	    
	    return $d && $d->format('d/m/Y H:i') === $date;
	}
}