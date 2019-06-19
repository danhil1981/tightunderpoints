                    <div id="attendance" class="d-none table-responsive">
                        <div class="text-center mb-5">
                            <a title="New Attendance Entry" href="<?php echo site_url()?>attendance/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>alarm_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_attendance">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Character</th>
                                    <th scope="col">Played By</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($attendance_list); $i++) {
                                        $attendance_entry = $attendance_list[$i];
                                        $played_entry = $played_list[$i];
                                        echo "<tr><th scope='row' class='fit align-middle'>" . $attendance_entry['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $attendance_entry['name_event'] . '</td>';
                                        echo "<td class='align-middle'>" . $attendance_entry['name_character'] . '</td>';
                                        echo "<td class='align-middle'>" . $played_entry['name_character'] . '</td>';
                                        echo "<td class='fit align-middle'><div class='btn-group'><a title='Modify " . $attendance_entry['name_event'] . ' - ' . $attendance_entry['name_character'] . "' href='" . site_url() . 'attendance/show_modify/' . $attendance_entry['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $attendance_entry['name_event'] . ' - ' . $attendance_entry['name_character'] . "' data-env='Attendance Entry' data-title='" . $attendance_entry['name_event'] . ' - ' . $attendance_entry['name_character'] . "' data-href='" . site_url() . 'attendance/delete/' . $attendance_entry['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>