            <script src="<?php echo base_url()?>assets/js/insert_attendance.js"></script>
            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Attendance List</h1>
                    <?php echo form_open_multipart('/attendance/show_confirm_officer_insert');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Event
                        </div>
                        <?php echo form_dropdown('id_event', $events, $id_event, "disabled required class='form-control'");?>
                    </div>
                    <?php $options = $character_names;?>
                    <div class="form-group">
                        <div id="label_characters" class="text-white mt-5 mb-2">
                            Character
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-center">
                            <?php echo form_dropdown('id_character', $options, '', "required id='character_dropdown' class='manual_input form-control'");?>
                            <button id="add_character" class="manual_input btn btn-sm btn-secondary form-control">Add to List</button>
                            <div class="form-control text-white text-center btn-secondary d-none" id="upload-file-info"></div>
                            <label class="btn btn-sm btn-success form-control" for="upload_input">
                                <span class="align-middle">Upload Log</span>
                                <?php echo form_upload('upload_characters', '', "id='upload_input' class='d-none'");?>
                            </label>
                        </div>
                    </div>
                    <div id="characters" class="d-none my-5">
                        <table class="table-sm text-center" id="table_characters">
                            <tbody>
                                <tr>
                                    <td id="tcell_characters"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php echo form_hidden('id_event', $id_event);?>
                    <input type="hidden" name="list_characters" id="list_characters" value="" />
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Create', "id='submit' class='btn btn-success btn-sm'");?>
                        <?php echo anchor('officers', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>