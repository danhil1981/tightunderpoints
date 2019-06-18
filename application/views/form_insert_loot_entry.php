            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Loot Entry</h1>
                    <?php echo form_open('loot/insert');?>
                    <?php $options = $drop_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Drop
                        </div>
                        <?php echo form_dropdown('id_drop', $options, '', "required class='form-control'");?>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Character
                        </div>
                        <?php echo form_dropdown('id_character', $options, '', "required class='form-control'");?>
                    </div>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-primary btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
