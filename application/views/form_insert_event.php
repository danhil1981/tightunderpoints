            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Event</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('events/insert');?>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Boss<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_boss', $options, '', 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php $options = $raid_descriptions;array_unshift($options,"-- Not part of a raid --");?>
                    <div class="form-group">
                        <div class="text-white">
                            Raid<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_raid', $options, '', 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Time<br/><br/>
                        </div>
                        <?php $timezone  = +1; echo form_time('time',gmdate("H:i", time()+ 3600*($timezone+date("I"))), 'required class="form-control"')?>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Date<br/><br/>
                        </div>
                        <?php echo form_date('date',gmdate('Y-m-d'), 'required class="form-control"')?>
                    </div>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-sm"');?>
                    <?php echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                </div>
            </div>
