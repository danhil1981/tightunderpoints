            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Item</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('items/modify');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Id
                        </div>
                        <?php echo form_number('id_new', $item['id_item'], "min='1' max='64000' required class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', $item['name'], "required maxlength='64' class='form-control'")?>
                    </div>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Drops From
                        </div>
                        <?php echo form_dropdown('id_boss', $options, $item['id_boss'], "required class='form-control'");?>
                    </div>
                    <?php $options = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Points
                        </div>
                        <?php echo form_dropdown('value', $options, $item['value'], "required class='form-control'");?>
                    </div>
                    <?php echo form_hidden('id', $item['id']);?>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Modify', "class='btn btn-success btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>