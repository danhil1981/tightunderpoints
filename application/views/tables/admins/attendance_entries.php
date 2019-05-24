                    <div id="attendance" class="d-none">
                        <div class="text-center mb-5">
                            <a href="<?php echo site_url()?>attendance/show_insert/"
                                class="btn btn-success btn-sm">New Attendance Entry</a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_attendance">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Character</th>
                                    <th scope="col">Played By</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($attendance_list); $i++) {
                                        $attendance_entry = $attendance_list[$i];
                                        $played_entry = $played_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $attendance_entry['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $attendance_entry['name_event'] . '</td>';
                                        echo "<td class='align-middle'>" . $attendance_entry['name_character'] . '</td>';
                                        echo "<td class='align-middle'>" . $played_entry['name_character'] . '</td>';
                                        echo "<td class='align-middle'><button data-env='Attendance Entry' data-title='" . $attendance_entry['id'] . "' data-href='" . site_url() . 'attendance/delete/' . $attendance_entry['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'attendance/show_modify/' . $attendance_entry['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <a href="<?php echo site_url()?>attendance/show_insert/"
                                class="btn btn-success btn-sm">New Attendance Entry</a>
                        </div>
                    </div>