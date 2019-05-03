                    <div id="characters" class="d-none">
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
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
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
                                        echo "<td class='align-middle'><button data-env='Character' data-title='" . $character['name'] . "' data-href='" . site_url() . 'characters/delete/' . $character['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'characters/show_modify/' . $character['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br />
                        <a href="<?php echo site_url()?>characters/show_insert/"
                            class="btn btn-success btn-sm">New Character</a>
                        <br /><br />
                    </div>