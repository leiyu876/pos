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
            'transfer_from' => 'Transfer From',
            'transfer_to' => 'Transfer To',
            'borrowed' => 'Borrowed',
            'return' => 'Return',
            'borrowed_added' => 'Borrowed Added',
            'borrowed_updated' => 'Borrowed Updated',
            'borrowed_deleted' => 'Borrowed Deleted',
        );

        return $list;
    }

    public function setCustomNotifications($product_id, $action, $action_by, $action_to) {
        var_dump('expression'); exit;
        $date = date('Y-m-d H:i:s', time());
        $this->db->where("from_date <=", $date);
        $this->db->where("till_date >=", $date);
        if (!$this->Owner) {
            if ($this->Supplier) {
                $this->db->where('scope', 4);
            } elseif ($this->Customer) {
                $this->db->where('scope', 1)->or_where('scope', 3);
            } elseif (!$this->Customer && !$this->Supplier) {
                $this->db->where('scope', 2)->or_where('scope', 3);
            }
        }
        $q = $this->db->get("notifications");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
