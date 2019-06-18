            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Attendance Entry</h1>
                    <?php echo form_open('attendance/modify');?>
                    <?php $options = $event_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Event
                        </div>
                        <?php echo form_dropdown('id_event', $options, $attendance_entry['id_event'], "required class='form-control'");?>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Character
                        </div>
                        <?php echo form_dropdown('id_character', $options, $attendance_entry['id_character'], "required class='form-control'");?>
                    </div>
                    <?php $options = $main_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Played By
                        </div>
                        <?php echo form_dropdown('id_points', $options, $attendance_entry['id_points'], "required class='form-control'");?>
                    </div>
                    <?php echo form_hidden('id', $attendance_entry['id']);?>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Modify', "class='btn btn-success btn-sm'");?>
                        <?php echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
