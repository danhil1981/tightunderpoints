                    <div id="events" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_events">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Raid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ($i = 0; $i < count($events_list); $i++) {
                                            $event = $events_list[$i];
                                            echo "<tr><td class='align-middle'>" . $event['timestamp'] . '</td>';
                                            echo "<td class='align-middle'>" . date('D j M, Y', strtotime($event['timestamp'])) . '</td>';
                                            echo "<td class='align-middle'><div class='btn boss boss_" . $event['id_boss'] . "'>" . $event['name_boss'] . '</div></td>';
                                            echo "<td class='align-middle'>";
                                            if (!isset($event['description_raid'])) {
                                                echo '-- not part of a raid --';
                                            } else {
                                                echo $event['description_raid'];
                                            }
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                        <br /><br />
                    </div>