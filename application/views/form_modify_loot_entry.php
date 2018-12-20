            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Loot Entry</h1>

                    <br/><br/>
        
                    <?php echo form_open_multipart('loot/modify');?>

                    <?php $options = $drop_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Drop<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_drop', $options, $loot_entry['id_drop'], 'required class="form-control"');?>
                        <br/><br/>
                    </div>

                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Character<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_character', $options, $loot_entry['id_character'], 'required class="form-control"');?>
                        <br/><br/>
                    </div>

                    <?php echo form_hidden('id',$loot_entry['id']);?>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');?>
                    <?php echo anchor('users/admin_panel', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>
