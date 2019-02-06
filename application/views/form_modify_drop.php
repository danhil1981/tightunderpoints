            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Drop</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('drops/modify');?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_event', $options, $drop['id_event'], 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php $options = $item_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Item<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_item', $options, $drop['id_item'], 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php echo form_hidden('id',$drop['id']);?>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-sm"');?>
                    <?php echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                </div>
            </div>
