                    <div id="roster" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_roster">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Player</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ($i = 0; $i < count($characters_list); $i++) {
                                            $character = $characters_list[$i];
                                            echo "<tr><td class='align-middle'><div class='btn character character_" . $character['id'] . "'>" . $character['name'] . '</div></td>';
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
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                        <br /><br />
                    </div>