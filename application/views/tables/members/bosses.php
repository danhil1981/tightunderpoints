                    <div id="bosses" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_bosses">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th></th>
                                    <th scope="col">Respawn Time</th>
                                    <td>
                                        </th>
                                    <th scope="col">Variance</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ($i = 0; $i < count($bosses_list); $i++) {
                                            $boss = $bosses_list[$i];
                                            echo "<tr><td class='align-middle'><div class='btn boss boss_" . $boss['id'] . "'>" . $boss['name'] . '</div></td>';
                                            echo '<td>' . $boss['respawn'] . '</td>';
                                            echo "<td class='align-middle'>";
                                            $hms = explode(':', $boss['respawn']);
                                            if ($hms[0] < 24) {
                                                echo $hms[0] . ' hours';
                                            } else {
                                                echo($hms[0] / 24) . ' days';
                                            }
                                            echo '</td>';
                                            echo '<td>' . $boss['variance'] . '</td>';
                                            echo "<td class='align-middle'>";
                                            $hms = explode(':', $boss['variance']);

                                            if ($hms[0] < 24) {
                                                if ($hms[0] == 0) {
                                                    echo 'none';
                                                } else {
                                                    echo intval($hms[0]) . ' hours';
                                                }
                                            } else {
                                                echo($hms[0] / 24) . ' days';
                                            }
                                            echo '</td>';
                                            echo "<td class='align-middle'>" . $boss['value'] . '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                        <br /><br />
                    </div>