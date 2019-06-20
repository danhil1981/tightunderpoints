                    <div id="timers" class="d-none table-responsive">
                        <div class="text-center mb-5">
                            <a title="Track new Event" href="<?php echo site_url()?>events/show_insert/officers"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>alarm_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_timers">
                            <thead>
                                <tr>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Last Killed</th>
                                    <th scope="col">Start Window</th>
                                    <th scope="col">End Window</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $timezone = +1;
                                    foreach ($timers as $value) {
                                        echo "<tr><td class='align-middle'><div class='btn boss boss_" . $value['id_boss'] . "'>" . $value['name_boss'] . '</div></td>';
                                        echo "<td class='align-middle'>" . date('D j M, H:i', strtotime($value['last_killed'])) . '</td>';
                                        echo "<td class='align-middle'>" . $value['start_window'] . '</td>';
                                        echo "<td class='align-middle'>" . $value['end_window'] . '</td>';
                                        echo "<td class='fit align-middle'>";
                                        if (gmdate('Y-m-d H:i:s', time() + 3600 * ($timezone + date('I'))) > $value['end_window']) {
                                            echo "<div title='Up' class='btn btn-sm btn-success'><i class='material-icons align-middle'>event_available</i></div></td><td class='fit align-middle'><a title='Track " . $value['name_boss'] . "' href='" . site_url() . 'events/show_insert/officers/' . $value['id_boss'] . "' class='btn btn-sm btn-primary'><i class='material-icons align-middle'>alarm_add</i></a>";
                                        } else {
                                            if (gmdate('Y-m-d H:i:s', time() + 3600 * ($timezone + date('I'))) < $value['start_window']) {
                                                echo "<div title='Down' class='btn btn-sm btn-danger'><i class='material-icons align-middle'>event_busy</i></div></td><td>";
                                            } else {
                                                echo "<div title='In Window' class='btn btn-sm btn-primary'><i class='material-icons align-middle'>indeterminate_check_box</i></div></td><td class='fit align-middle'><a title='Track " . $value['name_boss'] . "' href='" . site_url() . 'events/show_insert/officers/' . $value['id_boss'] . "' class='btn btn-sm btn-primary'><i class='material-icons align-middle'>alarm_add</i></a>";
                                            }
                                        }
                                        echo '</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>