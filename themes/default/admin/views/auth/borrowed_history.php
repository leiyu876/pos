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
            "aaSorting": [[0, "asc"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('auth/getBorrowedHistory') ?>',
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
                {"bSortable": true, "mRender": capitalizeFirstLetter},
            ]
        });
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= lang('Borrowed History'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th><?= lang("Record_ID") ?></th>
                            <th><?= lang("User ID") ?></th>
                            <th><?= lang("User Name") ?></th>
                            <th><?= lang("Product Code") ?></th>
                            <th><?= lang("Product Name") ?></th>
                            <th><?= lang("Borrowed Date") ?></th>
                            <th><?= lang("Return Date") ?></th>
                            <th><?= lang("Actual Return") ?></th>
                            <th><?= lang("Status") ?></th>
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

