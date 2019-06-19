                    <div id="events" class="d-none table-responsive">
                        <div class="text-center mb-5">
                            <a title="New Event" href="<?php echo site_url()?>events/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>alarm_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_events">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Raid</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($events_list); $i++) {
                                        $event = $events_list[$i];
                                        echo "<tr><th scope='row' class='fit align-middle'>" . $event['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $event['timestamp'] . '</td>';
                                        echo "<td class='align-middle'>" . $event['name_boss'] . '</td>';
                                        echo "<td class='align-middle'>" . $event['description_raid'] . '</td>';
                                        echo "<td class='fit align-middle'><div class='btn-group'><a title='Modify " . $event['timestamp'] . ' - ' . $event['name_boss'] . "' href='" . site_url() . 'events/show_modify/' . $event['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $event['timestamp'] . ' - ' . $event['name_boss'] . "' data-env='Event' data-title='" . $event['timestamp'] . ' - ' . $event['name_boss'] . "' data-href='" . site_url() . 'events/delete/' . $event['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>