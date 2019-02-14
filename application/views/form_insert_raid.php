            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Raid</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('raids/insert');?>
                    <div class="form-group">
                        <div class="text-white">
                            Description<br/><br/>
                        </div>
                        <?php echo form_input('description','','required  maxlength="512" class="form-control"')?>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Date<br/><br/>
                        </div>
                        <?php echo form_date('date',gmdate('Y-m-d'), 'required class="form-control"')?>
                    </div>
                    <?php
                        echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-sm"');
                        echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-sm"');
                        echo form_close();
                    ?>
                </div>
            </div>
