<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customemail_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function send_email($product_id, $action_to, $action, $about = 'product') {

        if($about == 'product') {
        
            $this->load->library('ion_auth');
            
            $product_detail = $this->site->getProductByID($product_id);
            $contact_detail = $this->site->getUser($action_to);
            $groups = $this->ion_auth->getUserGroup($action_to);
            
            $v = $this->email_view();

            $v = str_replace("{site_name}", $this->Settings->site_name, $v);
            $v = str_replace("{product_name}", $product_detail->name, $v);
            $v = str_replace("{product_code}", $product_detail->code, $v);
            $v = str_replace("{contact_person}", $contact_detail->first_name.' '.$contact_detail->last_name, $v);
            $v = str_replace("{company}", $groups->description, $v);
            $v = str_replace("{action}", $action, $v);

            $this->sma->send_email($contact_detail->email, 'Borrowed Product Details', $v);

        } elseif($about == 'user') {

            $contact_detail = $this->site->getUser($action_to);
            
            $v = $this->email_view_user();

            $v = str_replace("{site_name}", $this->Settings->site_name, $v);
            $v = str_replace("{iqama}", $contact_detail->iqama, $v);
            $v = str_replace("{first_name}", $contact_detail->first_name, $v);
            $v = str_replace("{complete_name}", $contact_detail->first_name.' '.$contact_detail->last_name, $v);
            $v = str_replace("{phone}", $contact_detail->phone, $v);
            $v = str_replace("{action}", $action, $v);
            $v = str_replace("{email}", $contact_detail->email, $v);

            $this->sma->send_email($contact_detail->email, 'Account Details', $v);
        }
    } 

    public function email_view() {

        return '
        <h3>{logo}</h3>
        <h4>Borrowed Product Details</h4>
        <p>
            Hello {contact_person} ({company}),
        </p>
        <p>
            Product({product_name}) with code({product_code}) was {action} to you. <br/>
            Please contact Admin to manage your borrowed products.
        </p>
        <p>
            Best regards,
            <br>
            {site_name}
        </p>';
    }

    public function email_view_user() {
        return '
            <h3>{logo}</h3>
            <h4>Login Details</h4>

            <p>Hello {first_name},</p>
            <p>We have {action} account for you to manage the product you will use from our company.</p>
            <p>Your details are:</p>
            <pre>
                Iqama: {iqama}
                Name: {complete_name}
                Phone: {phone}
                Email: {email}
            </pre>
            <p>
                Best regards,
                <br>
                {site_name}
            </p>
        ';
    }
}
