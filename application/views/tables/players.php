                    <div id="players" class="d-none">
                        <div class="text-center mb-5">
                            <a title="Add Player" href="<?php echo site_url()?>players/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>person_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_players">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($players_list); $i++) {
                                        $player = $players_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $player['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $player['name'] . '</td>';
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $player['name'] . "' href='" . site_url() . 'players/show_modify/' . $player['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $player['name'] . "' data-env='Player' data-title='" . $player['name'] . "' data-href='" . site_url() . 'players/delete/' . $player['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>