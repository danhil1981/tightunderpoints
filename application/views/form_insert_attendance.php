            <script src="<?php echo base_url()?>assets/js/insert_attendance.js"></script>
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Attendance List</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('/attendance/show_confirm_officer_insert');?>
                    <div class="form-group">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_event', $events, $id_event, "disabled required class='form-control'");?>
                        <br/>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div id="label_characters" class="text-white">
                            Character<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_character', $options, '', "required id='character_dropdown' class='manual_input form-control float-left'");?>
                            <button id="add_character" class="manual_input btn btn-sm btn-primary form-control float-left ml-2">Add to List</button>
                            <label class="btn btn-sm btn-primary float-right" for="upload_input">
                                <?php echo form_upload('upload_characters', '', "id='upload_input' class='d-none'");?>Upload Log
                            </label>
                            <div class="text-white float-right mr-2" id="upload-file-info"></div>
                        </div>
                        <br/><br/><br/>
                    </div>
                    <div id="characters" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center" id="table_characters">
                            <tbody>
                                <tr>
                                    <td id="tcell_characters"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php echo form_hidden('id_event', $id_event);?>
                    <input type="hidden" name="list_characters" id="list_characters" value="" />
                    <?php echo form_submit('submit', 'Create', "id='submit' class='btn btn-success btn-sm'");?>
                    <?php echo anchor('officers', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    <?php echo form_close();?>
                </div>
            </div>