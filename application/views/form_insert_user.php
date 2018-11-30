    
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 offset-3">
                        <h1 class="text-center text-white">New User</h1>

                        <br/><br/>
            
                        <?php echo form_open_multipart('users/insert');?>

                        <div class="form-group">
                            <div class="text-white">
                                Name<br/><br/>
                            </div>
                            <?php echo form_input('name','','required class="form-control"')?>
                        </div>
                        <div class="form-group">
                            <div class="text-white">
                                Password<br/><br/>
                            </div>
                            <?php echo form_password('password','','required class="form-control"')?>
                        </div>
                        <?php $options = array('1' => 'Admin','2' => 'Officer','3' => 'Member');?>
                        <div class="form-group">
                            <div class="text-white">
                                Type<br/><br/>
                            </div>
                            <?php echo form_dropdown('type', $options, 'required class="form-control"');?>
                        </div>
                        <?php 
                            echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');
                            echo anchor('users/admin_panel', 'Cancel', 'class="btn btn-danger btn-small"');
                            echo form_close();
                        ?>
                    </div>
                </div>
            </div>
