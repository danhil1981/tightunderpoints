            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Boss</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('bosses/modify');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', $boss['name'], "required maxlength='64' class='form-control'")?>
                    </div>
                    <?php $options = ['2:00:00' => '2 Hours', '6:00:00' => '6 Hours', '8:00:00' => '8 Hours', '10:00:00' => '10 Hours', '12:00:00' => '12 Hours', '18:00:00' => '18 Hours', '24:00:00' => '1 Day', '48:00:00' => '2 Days', '72:00:00' => '3 Days', '120:00:00' => '5 Days', '132:00:00' => '5,5 Days', '168:00:00' => '1 Week'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Respawn Time
                        </div>
                        <?php echo form_dropdown('respawn', $options, $boss['respawn'], "required class='form-control'");?>
                    </div>
                    <?php $options = ['0:00:00' => 'No Variance', '1:00:00' => '1 Hour', '2:00:00' => '2 Hours', '3:00:00' => '3 Hours', '6:00:00' => '6 Hours', '12:00:00' => '12 Hours', '24:00:00' => '24 Hours', '36:00:00' => '36 Hours', '72:00:00' => '72 Hours'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Variance
                        </div>
                        <?php echo form_dropdown('variance', $options, $boss['variance'], "required class='form-control'");?>
                    </div>
                    <?php $options = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Points
                        </div>
                        <?php echo form_dropdown('value', $options, $boss['value'], "required class='form-control'");?>
                    </div>
                    <?php echo form_hidden('id', $boss['id']);?>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Modify', "class='btn btn-primary btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>