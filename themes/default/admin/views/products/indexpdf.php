<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
#tableid {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#tableid td, #tableid th {
    border: 1px solid #ddd;
    padding: 1px;
}

#tableid tr:nth-child(even){background-color: #f2f2f2;}

#tableid tr:hover {background-color: #ddd;}

#tableid th {
    padding-top: 2px;
    padding-bottom: 2px;
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
                                <th><?= lang("name") ?></th>
                                <th><?= lang("code") ?></th>
                                <th><?= lang("barcode_symbology") ?></th>
                                <th><?= lang("brand") ?></th>
                                <th><?= lang("category_code") ?></th>
                                <th><?= lang("unit_code") ?></th>
                                <th><?= lang("sale") ?></th>
                                <th><?= lang("purchase") ?></th>
                                <th><?= lang("cost") ?></th>
                                <th><?= lang("price") ?></th>
                                <th><?= lang("alert_quantity") ?></th>
                                <th><?= lang("tax_rate") ?></th>
                                <th><?= lang("tax_method") ?></th>
                                <th><?= lang("subcategory_code") ?></th>
                                <th><?= lang("product_variants") ?></th>
                                <th><?= lang("quantity") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                foreach ($ids as $id)
                                {
                                    $product = $this->products_model->getProductDetail($id);

                                    $brand   = $this->site->getBrandByID($product->brand);

                                    $brand_name = $brand ? $brand->name : "";

                                    $base_unit = $sale_unit = $purchase_unit = '';
                                    if($units = $this->site->getUnitsByBUID($product->unit)) {
                                        foreach($units as $u) {
                                            if ($u->id == $product->unit) {
                                                $base_unit = $u->code;
                                            }
                                            if ($u->id == $product->sale_unit) {
                                                $sale_unit = $u->code;
                                            }
                                            if ($u->id == $product->purchase_unit) {
                                                $purchase_unit = $u->code;
                                            }
                                        }
                                    }

                                    echo "
                                        <tr>
                                            <td>".$product->name."</td>
                                            <td>".$product->code."</td>
                                            <td>".$product->barcode_symbology."</td>
                                            <td>".$brand_name."</td>
                                            <td>".$product->category_code."</td>
                                            <td>".$base_unit."</td>
                                            <td>".$sale_unit."</td>
                                            <td>".$purchase_unit."</td>
                                    ";

                                    if ($this->Owner || $this->Admin || $this->session->userdata('show_cost')) {
                                        echo "<td>".$product->cost."</td>";
                                    } else {
                                        echo "<td></td>";
                                    }
                                    if ($this->Owner || $this->Admin || $this->session->userdata('show_price')) {
                                        echo "<td>".$product->price."</td>";
                                    } else {
                                        echo "<td></td>";
                                    }

                                    $tax_method = $product->tax_method ? lang('exclusive') : lang('inclusive');

                                    $variants = $this->products_model->getProductOptions($id);
                                    $product_variants = '';
                                    if ($variants) {
                                        foreach ($variants as $variant) {
                                            $product_variants .= trim($variant->name) . '|';
                                        }
                                    }
                                    $quantity = $product->quantity;
                                    if ($wh) {
                                        if($wh_qty = $this->products_model->getProductQuantity($id, $wh)) {
                                            $quantity = $wh_qty['quantity'];
                                        } else {
                                            $quantity = 0;
                                        }
                                    }
                                    echo "
                                            <td>".$product->alert_quantity."</td>
                                            <td>".$product->tax_rate_name."</td>
                                            <td>".$tax_method."</td>
                                            <td>".$product->subcategory_code."</td>
                                            <td>".$product_variants."</td>
                                            <td>".$quantity."</td>
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


