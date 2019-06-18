                    <div id="characters" class="d-none">
                        <div class="text-center mb-5">
                            <a title="Add Character" href="<?php echo site_url()?>characters/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>person_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_characters">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Player</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($characters_list); $i++) {
                                        $character = $characters_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $character['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $character['name'] . '</td>';
                                        echo "<td class='align-middle'>" . $character['level'] . '</td>';
                                        echo "<td class='align-middle'>" . $character['class'] . '</td>';
                                        echo "<td class='align-middle'>";
                                        switch ($character['type']) {
                                                case '1': echo 'Main';
                                                break;
                                                case '2': echo 'Alt';
                                                break;
                                                default: echo 'Bot';
                                            }
                                        echo '</td>';
                                        echo "<td class='align-middle'>" . $character['name_player'] . '</td>';
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $character['name'] . "' href='" . site_url() . 'characters/show_modify/' . $character['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $character['name'] . "' data-env='Character' data-title='" . $character['name'] . "' data-href='" . site_url() . 'characters/delete/' . $character['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>