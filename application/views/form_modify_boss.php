<div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Boss</h1>

                    <br/><br/>
        
                    <?php echo form_open_multipart('bosses/modify');?>

                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input('name',$boss['name'],'required class="form-control"')?>
                        <br/>
                    </div>

                    <?php $options = array('2:00:00' => '2 Hours', '6:00:00' => '6 Hours', '8:00:00' => '8 Hours', '10:00:00' => '10 Hours', '12:00:00' => '12 Hours', '18:00:00' => '18 Hours', '24:00:00' => '1 Day', '48:00:00' => '2 Days', '72:00:00' => '3 Days', '120:00:00' => '5 Days', '132:00:00' => '5,5 Days', '168:00:00' => '1 Week');?>
                    <div class="form-group">
                        <div class="text-white">
                            Respawn Time<br/><br/>
                        </div>
                        <?php echo form_dropdown('respawn', $options, $boss['respawn'], 'required class="form-control"');?>
                        <br/>
                    </div>

                    <?php $options = array('0:00:00' => 'No Variance', '1:00:00' => '1 Hour', '2:00:00' => '2 Hours', '3:00:00' => '3 Hours', '6:00:00' => '6 Hours', '12:00:00' => '12 Hours', '24:00:00' => '24 Hours', '36:00:00' => '36 Hours', '72:00:00' => '72 Hours');?>
                    <div class="form-group">
                        <div class="text-white">
                            Variance<br/><br/>
                        </div>
                        <?php echo form_dropdown('variance', $options, $boss['variance'], 'required class="form-control"');?>
                        <br/>
                    </div>

                    <?php $options = range(1,10);?>
                    <div class="form-group">
                        <div class="text-white">
                            Points<br/><br/>
                        </div>
                        <?php echo form_dropdown('value', $options, $boss['value'], 'required class="form-control"');?>
                        <br/>
                    </div>
                    <?php echo form_hidden('id',$boss['id']);?>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');?>
                    <?php echo anchor('users/admin_panel', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>