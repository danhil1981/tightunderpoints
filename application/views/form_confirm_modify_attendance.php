            <script src="<?php echo base_url()?>assets/js/confirm_attendance.js"></script>
            <h1 class="text-center text-white">Attendance</h1>
            <div class="row my-5">
                <div class="col-8 offset-2" id="tables">
                    <?php echo form_open('/attendance/officer_modify');?>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center" id="table_users">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Botted</th>
                                    <th scope="col">By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($list_characters as $value) {
                                        echo "<tr id='" . $value . "'>";
                                        echo "<td><input type='text' hidden name='character_" . $value . "'/>" . $character_names[$value] . '</td>';
                                        if ($list_types[$value] != 1) {
                                            echo "<td><input id='botted_" . $value . "' type='checkbox' name='botted' class='checks form-control' checked='true' /></td>";
                                        } else {
                                            echo "<td><input id='botted_" . $value . "' type='checkbox' name='botted' class='checks form-control' /></td>";
                                        }
                                        echo '<td>' . form_dropdown('id_substituting_' . $value, [0 => '-- Select a character --'] + $list_mains, '', "id='dropdown_" . $value . "' class='dropdowns form-control d-none'") . '</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php echo form_hidden('id_event', $id_event);?>
                        <div class="text-center mt-5">
                            <?php echo form_submit('submit', 'Confirm', "class='btn btn-success btn-sm'");?>
                            <?php echo anchor('officers', 'Cancel', "class='btn btn-danger btn-sm'");?>
                        </div>
                        <?php echo form_close();?>
                    </form>
                </div>
            </div>
