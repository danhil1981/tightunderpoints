            <script src="<?php echo base_url()?>assets/js/drop.js"></script>
            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Drop</h1>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open('drops/insert');?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Event
                        </div>
                        <?php echo form_dropdown('id_event', $options, '', "id='event_dropdown' required class='form-control'");?>
                    </div>
                    <?php $options = $item_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Item
                        </div>
                        <?php echo form_dropdown('id_item', $options, '', "id='item_dropdown' required class='form-control'");?>
                    </div>
                    <div class="text-center my-5">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-primary btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
