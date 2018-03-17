<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
    var oTable;
    $(document).ready(function () {

        $('#pdf1').click(function (event) {
            event.preventDefault();
            window.location.href = "<?= admin_url('reports/getDamage_products/true')?>";
            return false;
        });

        oTable = $('#PRData').dataTable({
            "bProcessing": true,
            "sAjaxSource": '<?= admin_url('reports/getDamage_products') ?>'
        });
        /*
        oTable = $('#PRData').dataTable({
            "aaSorting": [[0, "dsc"], [1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('reports/getDamage_products') ?>',
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
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true}, 
            ]
        });
        */
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('Damage Products'); ?>
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
                            <th><?= lang("Product Code") ?></th>
                            <th><?= lang("Product Name") ?></th>
                            <th><?= lang("ID / IQAMA NO.") ?></th>
                            <th><?= lang("Full Name") ?></th>
                            <th><?= lang("Borrowed Date") ?></th>
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

