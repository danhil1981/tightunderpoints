            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New User</h1>
                    <br/><br/>
                    <div class="text-center">
                        <?php echo validation_errors();?>
                    </div>
                    <?php echo form_open("users/insert");?>
                    <div class="form-group">
                        <div class="text-white">
                            Name
                        <br/><br/>
                        
                        </div>
                        <?php echo form_input("name", "", "pattern='^[A-Za-z]+$' title='1 word consisting of uppercase/lowercase letters' maxlength='32' class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Password<br/><br/>
                        </div>
                        <?php echo form_password("password", "", "required maxlength='32' class='form-control'")?>
                    </div>
                    <?php $options = array("1" => "Admin", "2" => "Officer", "3" => "Member");?>
                    <div class="form-group">
                        <div class="text-white">
                            Type<br/><br/>
                        </div>
                        <?php echo form_dropdown("type", $options, "required class='form-control'");?>
                    </div>
                    <?php
                        echo form_submit("submit", "Create", "class='btn btn-success btn-sm'");
                        echo anchor("admins", "Cancel", "class='btn btn-danger btn-sm'");
                        echo form_close();
                    ?>
                </div>
            </div>
