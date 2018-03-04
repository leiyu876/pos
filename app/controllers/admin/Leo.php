<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Leo extends MY_Controller
{

    function index() {

        echo 'leo know the functions!';
    }

    function email_local() {
        // working
        /*
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'leiyu876@gmail.com',
            'smtp_pass' => 'mrprogrammer1989',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        */

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.solutel.sa',
            'smtp_port' => 25,
            'smtp_user' => 'leo@solutel.sa',
            'smtp_pass' => 'Solutel12',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1',
            'newline'=> "\r\n"
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('leo@solutel.sa', 'leo nuneza');
        $this->email->to('daloygwapo@gmail.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

        if ($this->email->send()) {
            return true;
        } else {
            throw new Exception($this->email->print_debugger(array('headers', 'subject')));
            return false;
        }
    }

    function email_server() {

        $this->sma->send_email('daloygwapo@gmail.com', 'Payment made for sale ', 'gwapo ko');
    }
}
