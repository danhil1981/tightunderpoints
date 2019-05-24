                    <div id="attendance" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_attendance">
                            <thead>
                                <tr>
                                    <th scope="col">Event</th>
                                    <th scope="col">Characters</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($events as $i => $value) {
                                        echo "<tr><td class='align-middle'>" . $value . '</td>';
                                        echo "<td class='align-middle'>";
                                        $found = false;
                                        for ($j = 0; $j < count($attendance_list); $j++) {
                                            $attendance_entry = $attendance_list[$j];
                                            $played_entry = $played_list[$j];
                                            if ($attendance_entry['id_event'] == $i) {
                                                if ($attendance_entry['name_character'] !== $played_entry['name_character']) {
                                                    echo "<div class='badge badge-secondary m-1'>" . $attendance_entry['name_character'] . ' ';
                                                    echo "<div class='badge badge-primary'>" . $played_entry['name_character'] . '</div></div>';
                                                } else {
                                                    echo "<div class='badge badge-primary m-1'>" . $attendance_entry['name_character'] . '</div>';
                                                }
                                                $found = true;
                                            }
                                        }
                                        echo '</td>';
                                        if ($found == true) {
                                            echo "<td class='align-middle'><a href='" . site_url() . 'attendance/show_officer_modify/' . $i . "' class='btn btn-warning btn-sm'>Modify List</a></td>";
                                        } else {
                                            echo "<td class='align-middle'><a href='" . site_url() . 'attendance/show_officer_insert/' . $i . "' class='btn btn-success btn-sm'>Create List</a></td>";
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>