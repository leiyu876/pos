<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('Borrow_Product'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo admin_form_open("products/product_borrow", $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>
            <div class="form-group">
                <?= lang('Search_Product', 'Search_Product'). ' *'; ?>
                <?php 
                    $pid = array();
                    if ($products == false) {
                                
                    } else {
                        foreach ($products as $product) {
                            if($product->status && $product->status == 'borrowed') continue;

                            $pid[$product->id] = $product->name .' ('.$product->code.')';
                        }
                    }
                ?>
                <?= form_dropdown('product_id', $pid, set_value('product_id'), 'class="form-control tip" id="product_id" style="width:100%;" required="required"'); ?>
                
            </div>
            <div class="form-group">
                <?= lang('Search_User', 'Search_User'). ' *'; ?>
                <?php 
                $ursid = array();
                if ($users == false) {
                            
                } else {
                    foreach ($users as $user) {
                        
                        if($user->group_id == '1' || $user->group_id == '2') continue;

                        $ursid[$user->id] = $user->first_name.' '.$user->last_name.' ('.$user->iqama.')';
                    }
                }
                ?>
                <?= form_dropdown('user_id', $ursid, set_value('user_id'), 'class="form-control tip" id="user_id" style="width:100%;" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang("Expected_Return_Date", "Expected_Return_Date"). ' *'; ?>
                <?php echo form_input('return_date', (isset($_POST['date']) ? $_POST['date'] : ""), 'class="form-control date" id="return_date" required="required"'); ?>
            </div>
        </div>      
        <div class="modal-footer">
            <?php echo form_submit('save', lang('Save'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>