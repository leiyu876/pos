<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CustomNotification_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getNotificationStatusList()
    {
        $list = array(
            'added' => 'Added',
            'removed' => 'Removed',
            'updated' => 'Updated',
            'transfered_from' => 'Transfered From',
            'transfered_to' => 'Transfered To',
            'borrowed' => 'Borrowed',
            'returned' => 'Returned',
            'borrowed_updated' => 'Borrowed Updated',
            'borrowed_deleted' => 'Borrowed Deleted',
        );

        return $list;
    }

    public function addNotification($product_id, $action, $action_by, $action_to) {
        
        $data = array(
            'product_id' => $product_id,
            'action' => $action,
            'action_by' => $action_by,
            'action_to' => $action_to,
            'action_date' => date('Y-m-d H:i:s'),
        );

        if ($this->db->insert("custom_notifications", $data));  
    }
}
