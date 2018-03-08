<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
    var oTable;
    $(document).ready(function () {

        oTable = $('#PRData').dataTable({
            
        });
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('Filter'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <?= admin_form_open_multipart("reports/products_typebrand");?>
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= lang("category", "category") ?>
                            <?php
                            $cat[''] = "All";
                            if ($categories == false) {
                                
                            } else {
                                foreach ($categories as $category) {
                                    $cat[$category->id] = $category->name;
                                }
                            }
                            echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ''), 'class="form-control select" id="category" placeholder="' . lang("select") . " " . lang("category") . '"  style="width:100%"')
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= lang("brand", "brand") ?>
                            <?php
                            $br[''] = "All";
                            if ($brands == false) {
                                
                            } else {
                                foreach ($brands as $brand) {
                                    $br[$brand->id] = $brand->name;
                                }
                            }
                            echo form_dropdown('brand', $br, (isset($_POST['brand']) ? $_POST['brand'] : ''), 'class="form-control select" id="brand" placeholder="' . lang("select") . " " . lang("brand") . '" style="width:100%"');
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= form_submit('search', lang("Search Products"), 'class="btn btn-primary btn-lg" style="margin-top:18px"'); ?>
                        </div>
                    </div>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('Products by Type or Brand'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th><?= lang("Code") ?></th>
                            <th><?= lang("Name") ?></th>
                            <th><?= lang("Price") ?></th>
                            <th><?= lang("Category / Type") ?></th>
                            <th><?= lang("Brand / Model") ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $this->load->helper('mydatatable');
                                foreach ($datatable_list as $key => $value) {                                    
                                    echo '
                                    <tr>
                                        <td>'.$value['code'].'</td>
                                        <td>'.$value['name'].'</td>
                                        <td>'.formatMoneyWithPercentYearLess($value['id']).'</td>
                                        <td>'.$value['category_name'].'</td>
                                        <td>'.$value['brand_name'].'</td>
                                    </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

