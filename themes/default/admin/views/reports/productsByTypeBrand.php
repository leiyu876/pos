<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('filter'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <?= admin_form_open_multipart("reports/products_typebrand");?>
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= lang("category_type", "category") ?>
                            <?php
                            $cat[0] = "All";
                            if ($categories == false) {
                                
                            } else {
                                foreach ($categories as $category) {
                                    $cat[$category->id] = $category->name;
                                }
                            }
                            echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ''), 'class="form-control select" id="category" placeholder="' . lang("select") . " " . lang("category") . '"  style="width:100%" onChange="changecat(this.value);"')
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= lang("brand_model", "brand") ?>
                            <?php
                            /*
                            $br[''] = "All";
                            if ($brands == false) {
                                
                            } else {
                                foreach ($brands as $brand) {
                                    $br[$brand->id] = $brand->name;
                                }
                            }
                            echo form_dropdown('brand', $br, (isset($_POST['brand']) ? $_POST['brand'] : ''), 'class="form-control select" id="brand" placeholder="' . lang("select") . " " . lang("brand") . '" style="width:100%"');
                            */
                            echo form_dropdown('brand', array(), (isset($_POST['brand']) ? $_POST['brand'] : ''), 'class="form-control select" id="brand" placeholder="' . lang("select") . " " . lang("brand") . '"  style="width:100%"');
                            ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?= form_submit('search', lang("search_products"), 'class="btn btn-primary btn-lg" style="margin-top:18px"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-lg" style="margin-top:18px" id="pdf1"><?=lang("download_pdf")?></button>
                        </div>
                    </div>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>

    // on category change then brands  must be change
    var brandsByCategory = JSON.parse('<?= $categories_brands ?>');
    
    function changecat(value) {

        var selected = "<?= (isset($_POST['brand']) ? $_POST['brand'] : '') ?>";

        if (value.length == 0) {
            document.getElementById("brand").innerHTML = "<option></option>";
        } else {
            var catOptions = "";
            for (categoryId in brandsByCategory[value]) {
                var sel = "";
                if(selected == categoryId) {
                    
                    sel = "selected='selected'";
                }
                catOptions += "<option value="+categoryId+" "+sel+">" + brandsByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("brand").innerHTML = catOptions;
        }
    }
    var e = document.getElementById("category");
    
    var strUser = e.options[e.selectedIndex].value;
    changecat(strUser);
    // end

    var oTable;
    $(document).ready(function () {

        $('#pdf1').click(function (event) {
            event.preventDefault();
            window.location.href = "<?= admin_url('reports/products_typebrand/true')?>";
            return false;
        });

        oTable = $('#PRData').dataTable({
            
        });
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('typebrand_products'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th><?= lang("product_code") ?></th>
                            <th><?= lang("product_name") ?></th>
                            <th><?= lang("product_price") ?></th>
                            <th><?= lang("category_type") ?></th>
                            <th><?= lang("brand_model") ?></th>
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

