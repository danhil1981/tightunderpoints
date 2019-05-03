                    <div id="players" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_players">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($players_list); $i++) {
                                        $player = $players_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $player['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $player['name'] . '</td>';
                                        echo "<td class='align-middle'><button data-env='Player' data-title='" . $player['name'] . "' data-href='" . site_url() . 'players/delete/' . $player['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'players/show_modify/' . $player['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br />
                        <a href="<?php echo site_url()?>players/show_insert/"
                            class="btn btn-success btn-sm">New Player</a>
                        <br /><br />
                    </div>