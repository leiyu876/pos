<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('Reason for deleting'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo admin_form_open("products/delete_note/".$product_details->id, $attrib); ?>
        <div class="modal-body">
            <div class="form-group">
                <?= lang('status'); ?>
                <?php 
                $opts = array();
                if ($delete_option_list == false) {
                            
                } else {
                    foreach ($delete_option_list as $key => $val) {
                        $opts[$key] = $val;
                    }
                }
                ?>
                <?= form_dropdown('delete_status', $opts, set_value('status', $product_details->status), 'class="form-control tip" id="status" style="width:100%;" required="required"'); ?>
            </div>
            
            <div class="form-group">
                <?= lang("Notes"); ?>
                <?php echo form_textarea('delete_notes', '', 'class="form-control" id="notes" required="required"'); ?>
            </div>            
        </div>
        <div class="modal-footer">
            <?php echo form_submit('save', lang('Proceed'), 'class="btn btn-danger"'); ?>
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
