<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function asteriskToRed(string) {
        laststr =  string.slice(-1);
        if(laststr == '*') {
            return string.substring(0, string.length-1) + '<span style="color:red"> *</span>';
        }
        return string;
    }
    var oTable;
    $(document).ready(function () {

        $('#pdf1').click(function (event) {
            event.preventDefault();
            window.location.href = "<?= admin_url('products/downloadBorrowedProductsPdf')?>";
            return false;
        });

        oTable = $('#PRData').dataTable({
            "aaSorting": [[0, "dsc"], [1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('products/getBorrowedProducts') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true, "mRender": asteriskToRed},
                {"bSortable": true},
                {"bSortable": true}, 
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},        
                {"bSortable": true},        
                {"bSortable": true, "mRender": capitalizeFirstLetter},
                {"bSortable": false}, 
            ]
        });
    });
</script>
<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('products/product_actions'.($warehouse_id ? '/'.$warehouse_id : ''), 'id="action-form"');
} ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('borrowed_products'); ?>
        </h2>
        <? if ($Owner || $Admin) { ?>
            <div class="box-icon">
                <ul class="btn-tasks">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                        </a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li>
                                <a href="<?php echo admin_url('products/product_borrow'); ?>" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-plus"></i> <?= lang('borrow_product') ?>
                                </a>

                            </li>
                            <li>
                                <a href="<?php echo admin_url('products/return_products'); ?>">
                                    <i class="fa fa-arrow-left"></i> <?= lang('returned_products') ?>
                                </a>

                            </li>
                            <li>
                                <a href="<?php echo admin_url('products/unreturn'); ?>">
                                    <i class="fa fa-arrow-right"></i> <?= lang('unreturned_products') ?>
                                </a>

                            </li>
                            <li>
                                <a href="#" id="pdf1">
                                    <i class="fa fa-file-pdf-o"></i> <?= lang('download_pdf') ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        <? } ?>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th><?= lang("record_id") ?></th>
                            <th><?= lang("id_iqama") ?></th>
                            <th><?= lang("full_name") ?></th>
                            <th><?= lang("product_code") ?></th>
                            <th><?= lang("product_name") ?></th>
                            <th><?= lang("borrowed_date") ?></th>
                            <th><?= lang("return_date") ?></th>
                            <th><?= lang("actual_return_date") ?></th>
                            <th><?= lang("status") ?></th>
                            <th><?= lang("time_consumed") ?></th>
                            <th><?= lang("delay") ?></th>
                            <th><?= lang("actions") ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="11" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

