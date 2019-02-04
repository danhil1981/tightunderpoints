            <script src="<?php echo base_url()?>assets/js/attendance.js"></script>
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Attendance List</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('officers/insert_attendance');?>
                    <div class="form-group">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_event', $events, $id_event, 'disabled required class="form-control"');?>
                        <br/>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Character<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_character', $options, '', 'required id="character_dropdown" class="form-control float-left"');?>
                            <button id="add_character" class="btn btn-sm btn-primary form-control float-left ml-2">Add</button>
                        </div>
                        <br/><br/><br/>
                    </div>
                    <?php echo form_hidden('id_event',$id_event);?>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-success btn-small"');?>
                    <?php echo anchor('officers', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>