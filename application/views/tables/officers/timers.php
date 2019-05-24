                    <div id="timers" class="d-none">
                        <div class="text-center mb-5">
                            <a href="<?php echo site_url()?>events/show_insert/officers"
                                class="btn btn-success btn-sm">New Event</a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_timers">
                            <thead>
                                <tr>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Last Killed</th>
                                    <th scope="col">Start Window</th>
                                    <th scope="col">End Window</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $timezone = +1;
                                    foreach ($timers as $value) {
                                        echo "<tr><td class='align-middle'><div class='btn boss boss_" . $value['id_boss'] . "'>" . $value['name_boss'] . '</div></td>';
                                        echo "<td class='align-middle'>" . $value['last_killed'] . '</td>';
                                        echo "<td class='align-middle'>" . $value['start_window'] . '</td>';
                                        echo "<td class='align-middle'>" . $value['end_window'] . '</td>';
                                        echo "<td class='align-middle'>";
                                        if (gmdate('Y-m-d H:i:s', time() + 3600 * ($timezone + date('I'))) > $value['end_window']) {
                                            echo "<div class='btn btn-sm btn-block btn-success'>UP</div></td><td class='align-middle'><a href='" . site_url() . 'events/show_insert/officers/' . $value['id_boss'] . "' class='btn btn-sm btn-block btn-primary'>Create Event</a>";
                                        } else {
                                            if (gmdate('Y-m-d H:i:s', time() + 3600 * ($timezone + date('I'))) < $value['start_window']) {
                                                echo "<div class='btn btn-sm btn-block btn-danger'>DOWN</div></td><td>";
                                            } else {
                                                echo "<div class='btn btn-sm btn-block btn-warning'>IN WINDOW</div></td><td class='align-middle'><a href='" . site_url() . 'events/show_insert/officers/' . $value['id_boss'] . "' class='btn btn-sm btn-block  btn-primary'>Create Event</a>";
                                            }
                                        }
                                        echo '</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <a href="<?php echo site_url()?>events/show_insert/officers"
                                class="btn btn-success btn-sm">New Event</a>
                        </div>
                    </div>