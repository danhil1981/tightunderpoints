            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Item</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('items/insert');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Id
                        </div>
                        <?php echo form_number('id', '', "min='1' max='64000' required class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', '', "required maxlength='64' class='form-control'")?>
                    </div>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Drops From
                        </div>
                        <?php echo form_dropdown('id_boss', $options, '', "required class='form-control'");?>
                    </div>
                    <?php $options = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Points
                        </div>
                        <?php echo form_dropdown('value', $options, '', "required class='form-control'");?>
                    </div>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-primary btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>