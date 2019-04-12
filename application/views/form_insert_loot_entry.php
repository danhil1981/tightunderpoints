            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Loot Entry</h1>
                    <br/><br/>
                    <?php echo form_open('loot/insert');?>
                    <?php $options = $drop_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Drop<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_drop', $options, '', "required class='form-control'");?>
                        <br/><br/>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Character<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_character', $options, '', "required class='form-control'");?>
                        <br/><br/>
                    </div>
                    <?php echo form_submit('submit', 'Create', "class='btn btn-success btn-sm'");?>
                    <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    <?php echo form_close();?>
                </div>
            </div>
