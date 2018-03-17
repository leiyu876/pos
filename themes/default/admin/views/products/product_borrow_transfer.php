<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('Transfer'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo admin_form_open("products/TransferToOtherUser/".$borrowed->pb_id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>
            <div class="form-group">
                <?= lang('Product Name : '); ?>
                <?php 
                $opts[0] = "";
                if ($products == false) {
                            
                } else {
                    foreach ($products as $product) {

                        $opts[$product->id] = $product->name .' ('.$product->code.')';
                    }
                }
                ?>
                <?= form_input('product_id', $opts[$borrowed->product_id], 'class="form-control tip" id="product_id" style="width:100%;" readonly'); ?>
            </div>
            <div class="form-group">
                <?= lang('Transfer From :'); ?>
                <?php 
                $opts[''] = "";
                if ($users == false) {
                            
                } else {
                    foreach ($users as $user) {
                        
                        $opts[$user->id] = $user->first_name.' '.$user->last_name.' ('.$user->iqama.')';
                    }
                }
                ?>
                <?= form_input('user_id_from', $opts[$borrowed->userid], 'class="form-control tip" id="user_id" style="width:100%;" readonly'); ?>
            </div>
            <div class="form-group">
                <?= lang('Transfer To :'); ?>
                <?php 
                $opts = array();
                if ($users == false) {
                            
                } else {
                    foreach ($users as $user) {
                        if($user->id == $borrowed->userid) continue;
                        if($user->group_id == '1' || $user->group_id == '2') continue;
                        $opts[$user->id] = $user->first_name.' '.$user->last_name.' ('.$user->iqama.')';
                    }
                }
                ?>
                <?= form_dropdown('user_id', $opts, set_value('user_id', $borrowed->userid), 'class="form-control tip" id="user_id" style="width:100%;" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang("Expected_Return_Date", "Expected_Return_Date"). ' *'; ?>
                <?php echo form_input('return_date', $this->sma->hrsd($borrowed->return_date), 'class="form-control date" id="return_date" required="required"'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('save', lang('Save Changes'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
<script type="text/javascript">
    $(document).ready(function() {
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
