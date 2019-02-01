            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Attendance Entry</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('attendance/insert');?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_event', $options, '', 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Character<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_character', $options, '', 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');?>
                    <?php echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>
