            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Item</h1>
                    <br/><br/>
                    <?php echo form_open('items/insert');?>
                    <div class="form-group">
                        <div class="text-white">
                            Id<br/><br/>
                        </div>
                        <?php echo form_number('id', '', "min='1' max='32768' required class='form-control'")?>
                        <br/>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input('name', '', "required maxlength='64' class='form-control'")?>
                        <br/>
                    </div>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Drops From<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_boss', $options, '', "required class='form-control'");?>
                        <br/><br/>
                    </div>
                    <?php $options = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15'];?>
                    <div class="form-group">
                        <div class="text-white">
                            Points<br/><br/>
                        </div>
                        <?php echo form_dropdown('value', $options, '', "required class='form-control'");?>
                        <br/>
                    </div>
                    <?php echo form_submit('submit', 'Create', "class='btn btn-success btn-sm'");?>
                    <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    <?php echo form_close();?>
                </div>
            </div>
