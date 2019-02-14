            <script src="<?php echo base_url()?>assets/js/drop.js"></script>
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Drop</h1>
                    <br/><br/>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open_multipart('drops/insert');?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_event', $options, '', 'id="event_dropdown" required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php $options = $item_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Item<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_item', $options, '', 'id="item_dropdown" required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-sm"');?>
                    <?php echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                </div>
            </div>
