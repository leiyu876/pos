<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i><?= $page_title; ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th><?= lang("Product") ?></th>
                            <th><?= lang("Action") ?></th>
                            <th><?= lang("User Involve") ?></th>
                            <th><?= lang("Date") ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <? foreach ($notifictions as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->name.' ('. $value->code.')'?></td>
                                    <td><?= $value->action ?></td>
                                    <td><?= $value->first_name.' '.$value->last_name.' ('. $value->iqama.')' ?></td>
                                    <td><?= $value->action_date ?></td>
                                </tr>
                            <?} ?>
                        </tbody>
                    </table>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

