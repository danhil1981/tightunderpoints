            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify User</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('users/modify');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', $user['name'], "required pattern='^[A-Za-z]+$' title='1 word consisting of uppercase/lowercase letters' maxlength='32' class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Password
                        </div>
                        <?php echo form_password('password', set_value('password', $user['password']), "required maxlength='32' class='form-control'")?>
                    </div>
                    <?php $options = ['1' => 'Admin', '2' => 'Officer', '3' => 'Member'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Type
                        </div>
                        <?php echo form_dropdown('type', $options, $user['type'], "required class='form-control'");?>
                    </div>
                    <?php echo form_hidden('id', $user['id']);?>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Modify', "class='btn btn-success btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>