<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('Update'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo admin_form_open("products/edit_borrowed/".$borrowed->pb_id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>
            <div class="form-group">
                <?= lang('Search_Product', 'Search_Product'). ' *'; ?>
                <?php 
                $opts[''] = "";
                if ($products == false) {
                            
                } else {
                    foreach ($products as $product) {
                        $opts[$product->id] = $product->name .' ('.$product->code.')';
                    }
                }
                ?>
                <?= form_dropdown('product_id', $opts, set_value('product_id', $borrowed->product_id), 'class="form-control tip" id="product_id" style="width:100%;" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('Search_User', 'Search_User'). ' *'; ?>
                <?php 
                $usrid[''] = "";
                if ($users == false) {
                            
                } else {
                    foreach ($users as $user) {

                        if($user->group_id == '1' || $user->group_id == '2') continue;

                        $usrid[$user->id] = $user->first_name.' '.$user->last_name.' ('.$user->id.')';
                    }
                }
                ?>
                <?= form_dropdown('user_id', $usrid, set_value('user_id', $borrowed->userid), 'class="form-control tip" id="user_id" style="width:100%;" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang("Expected_Return_Date", "Expected_Return_Date"). ' *'; ?>
                <?php echo form_input('return_date', $this->sma->hrsd($borrowed->return_date), 'class="form-control input-tip datetime" id="return_date" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('Status', 'Status'). ' *'; ?>
                <?php 
                $opts = array();
                if ($status_list == false) {
                            
                } else {
                    foreach ($status_list as $key => $val) {
                        $opts[$key] = $val;
                    }
                }
                ?>
                <?= form_dropdown('status', $opts, set_value('status', $borrowed->status), 'class="form-control tip" id="status" style="width:100%;" required="required"'); ?>
            </div>
            <div class="form-group" id="return_status" style="display:none">
                <?= lang("Item Status", "return_status"); ?>
                <?php 
                    $opts = array();
                    if ($return_status_list == false) {
                                
                    } else {
                        foreach ($return_status_list as $key => $val) {
                            $opts[$key] = $val;
                        }
                    }
                ?>
                <?= form_dropdown('return_status', $opts, set_value('return_status', $borrowed->return_status), 'class="form-control tip" id="return_status" style="width:100%;" required="required"'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('save', lang('Update'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
<script type="text/javascript">
    $(document).ready(function() {

        $( '#status' ).change(function() {
            if($( '#status' ).val() == 'returned') {
                $('#return_status').slideDown();
            } else {
                $('#return_status').slideUp();
            }          
        });

        $('#base_unit').change(function(e) {
            var bu = $(this).val();
            if(bu > 0)
                $('#measuring').slideDown();
            else
                $('#measuring').slideUp();
        });
        var obu = <?= !empty($unit->base_unit) ? $unit->base_unit : 0; ?>;
        if(obu > 0)
            $('#measuring').slideDown();
        else
            $('#measuring').slideUp();
    });
</script>
