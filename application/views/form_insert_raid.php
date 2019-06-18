            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Raid</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('raids/insert');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Description
                        </div>
                        <?php echo form_input('description', '', "required  maxlength='512' class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Date
                        </div>
                        <?php echo form_date('date', gmdate('Y-m-d'), "required class='form-control'")?>
                    </div>
                    <div class="text-center mt-5">
                    <?php
                        echo form_submit('submit', 'Create', "class='btn btn-primary btn-sm'");
                        echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");
                        echo form_close();
                    ?>
                    </div>
                </div>
            </div>