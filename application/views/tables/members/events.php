                    <div id="events" class="d-none table-responsive">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_events">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Raid</th>
                                    <th scope="col">DPS</th>
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
                                            echo "<td class='fit align-middle'>";
                                            if ($event['url_parse'] != null) {
                                                echo "<a title='DPS Parse for " . $event['timestamp'] . ' - ' . $event['name_boss'] . "' href='".$event['url_parse'] . "' target='_blank' class='btn btn-primary btn-sm'><i class='material-icons align-middle'>web</i></a>";
                                            }
                                            else {
                                                echo "<button title='No Parse Available' href='' class='btn btn-light btn-sm' disabled><i class='material-icons align-middle'>web</i></button>";
                                            }
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>