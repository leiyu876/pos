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
                                <th><?= lang("Record_ID") ?></th>
                                <th><?= lang("User ID") ?></th>
                                <th><?= lang("User Name") ?></th>
                                <th><?= lang("Product Code") ?></th>
                                <th><?= lang("Product Name") ?></th>
                                <th><?= lang("Borrowed Date") ?></th>
                                <th><?= lang("Return Date") ?></th>
                                <th><?= lang("Status") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                foreach ($query->result() as $row)
                                {
                                    echo "
                                        <tr>
                                            <td>".$row->id."</td>
                                            <td>".$row->user_id."</td>
                                            <td class='asterisk'>".$row->user_name."</td>
                                            <td>".$row->product_code."</td>
                                            <td>".$row->product_name."</td>
                                            <td>".$row->borrowed_date."</td>
                                            <td>".$row->return_date."</td>
                                            <td>".$row->status."</td>
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


