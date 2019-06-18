            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Raid</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('raids/modify');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Description
                        </div>
                        <?php echo form_input('description', $raid['description'], "required maxlength='32' class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Date
                        </div>
                        <?php echo form_date('date', $raid['date'], "required class='form-control'")?>
                    </div>
                    <div class="text-center mt-5">
                    <?php
                        echo form_hidden('id', $raid['id']);
                        echo form_submit('submit', 'Modify', "class='btn btn-success btn-sm'");
                        echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");
                        echo form_close();
                    ?>
                    </div>
                </div>
            </div>