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
                                <th><?= lang("product_code") ?></th>
                                <th><?= lang("product_name") ?></th>
                                <th><?= lang("id_iqama") ?></th>
                                <th><?= lang("full_name") ?></th>
                                <th><?= lang("borrowed_date") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                foreach ($lists as $row) {
                                    echo "<tr>";
                                        foreach ($row as $v) {
                                            echo "<td>".$v."</td>";
                                        }
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


