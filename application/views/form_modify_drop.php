            <script src="<?php echo base_url()?>assets/js/drop.js"></script>
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Drop</h1>
                    <br/><br/>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open("drops/modify");?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <?php echo form_dropdown("id_event", $options, $drop["id_event"], "required id='event_dropdown' class='form-control'");?>
                        <br/><br/>
                    </div>
                    <?php $options = $item_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Item<br/><br/>
                        </div>
                        <?php echo form_dropdown("id_item", $options, $drop["id_item"], "required id='item_dropdown' class='form-control'");?>
                        <br/><br/>
                    </div>
                    <?php echo form_hidden("id", $drop["id"]);?>
                    <input type="hidden" id="id_item" value="<?php echo $drop["id_item"]?>"/>
                    <?php echo form_submit("submit", "Modify", "class='btn btn-success btn-sm'");?>
                    <?php echo anchor("admins", "Cancel", "class='btn btn-danger btn-sm'");?>
                    <?php echo form_close();?>
                </div>
            </div>
