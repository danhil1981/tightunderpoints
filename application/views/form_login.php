            <?php $this->session->userdata = []; ?>
            <div class="row">
                <div class="col-10 offset-1 text-center">
                    <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                    ?>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Login</h1>
                    <?php echo form_open('users/process_login');?>
                    <div class="form-group">
                        <div class="text-center text-white mt-5 mb-2">
                            User
                        </div>
                        <?php echo form_input('user', '', "autofocus required class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-center text-white mt-5 mb-2">
                            Password
                        </div>
                        <?php echo form_password('password', '', "required class='form-control'")?>
                        <div class="text-center mt-5">
                            <?php echo form_submit('submit', 'Log In', "class='btn btn-success btn-sm'");?>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>