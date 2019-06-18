            <script src="<?php echo base_url()?>assets/js/drop.js"></script>
            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Drop</h1>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open('drops/modify');?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Event
                        </div>
                        <?php echo form_dropdown('id_event', $options, $drop['id_event'], "required id='event_dropdown' class='form-control'");?>
                    </div>
                    <?php $options = $item_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Item
                        </div>
                        <?php echo form_dropdown('id_item', $options, $drop['id_item'], "required id='item_dropdown' class='form-control'");?>
                    </div>
                    <?php echo form_hidden('id', $drop['id']);?>
                    <input type="hidden" id="id_item" value="<?php echo $drop['id_item']?>"/>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Modify', "class='btn btn-success btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
