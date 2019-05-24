            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New User</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('users/insert');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', '', "required pattern='^[A-Za-z]+$' title='1 word consisting of uppercase/lowercase letters' maxlength='32' class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Password
                        </div>
                        <?php echo form_password('password', '', "required maxlength='32' class='form-control'")?>
                    </div>
                    <?php $options = ['1' => 'Admin', '2' => 'Officer', '3' => 'Member'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Type
                        </div>
                        <?php echo form_dropdown('type', $options, '', "required class='form-control'");?>
                    </div>
                    <div class="text-center mt-5">
                    <?php
                        echo form_submit('submit', 'Create', "class='btn btn-success btn-sm'");
                        echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");
                        echo form_close();
                    ?>
                    </div>
                </div>
            </div>