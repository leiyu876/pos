<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
#tableid {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#tableid td, #tableid th {
    border: 1px solid #ddd;
    padding: 8px;
}

#tableid tr:nth-child(even){background-color: #f2f2f2;}

#tableid tr:hover {background-color: #ddd;}

#tableid th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #428BCA;
    color: white;
}
</style>
<div class="box">
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <table id="tableid">
                        <thead>
                            <tr>
                                <th><?= lang("first_name") ?></th>
                                <th><?= lang("last_name") ?></th>
                                <th><?= lang("email_address") ?></th>
                                <th><?= lang("company") ?></th>
                                <th><?= lang("group") ?></th>
                                <th><?= lang("status") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                foreach ($ids as $id)
                                {
                                    $user   = $this->site->getUser($id);

                                    $group  = $this->site->getUserGroup($id);

                                    $status = $user->active ? "Active" : "Inactive";

                                    echo "
                                        <tr>
                                            <td>".$user->first_name."</td>
                                            <td>".$user->last_name."</td>
                                            <td>".$user->email."</td>
                                            <td>".$user->company."</td>
                                            <td>".$group->name."</td>
                                            <td>".$status."</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


