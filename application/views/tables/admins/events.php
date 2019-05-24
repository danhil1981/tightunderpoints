                    <div id="events" class="d-none">
                        <div class="text-center mb-5">
                            <a href="<?php echo site_url()?>events/show_insert/"
                                class="btn btn-success btn-sm">New Event</a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_events">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Raid</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($events_list); $i++) {
                                        $event = $events_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $event['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $event['timestamp'] . '</td>';
                                        echo "<td class='align-middle'>" . $event['name_boss'] . '</td>';
                                        echo "<td class='align-middle'>" . $event['description_raid'] . '</td>';
                                        echo "<td class='align-middle'><button data-env='Event Entry' data-title='" . $event['id'] . "' data-href='" . site_url() . 'events/delete/' . $event['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'events/show_modify/' . $event['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <a href="<?php echo site_url()?>events/show_insert/"
                                class="btn btn-success btn-sm">New Event</a>
                        </div>
                    </div>