            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Player</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('players/insert');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', '', "required pattern='^[A-Za-z]+$' maxlength='32' title='1 word consisting of uppercase/lowercase letters' class='form-control'")?>
                    </div>
                    <?php echo form_hidden('source', $source);?>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-primary btn-sm'");?>
                        <?php echo anchor($source, 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>