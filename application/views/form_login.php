<?php
    $this->session->userdata = array();

    if(isset($msg)) echo $msg;
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class='text-center text-white'>Login</h1>

                <?php echo form_open('users/process_login');?>
                <div class="form-group">
                    <div class="text-center text-white">
                        User<br/>
                    </div>
                    <?php echo form_input('user','','class="form-control"')?>
                </div>
                <div class="form-group">
                    <div class="text-center text-white">
                        Password<br/>
                    </div>
                    <?php echo form_password('password','','class="form-control"')?><br/>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary form-control"');?>
                </div>
                <div class="text-center">
                    <?php echo form_close();?>
            </div>
        </div> 
    </div>

