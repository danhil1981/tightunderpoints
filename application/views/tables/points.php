                    <div id="points" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_points">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">All Time Earned</th>
                                    <th scope="col">All Time Spent</th>
                                    <th scope="col">Earned last 50 days</th>
                                    <th scope="col">Spent last 50 days</th>
                                    <th scope="col">Available Points</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($list_names as $i => $value) {
                                        echo "<tr><td id='name_$i' class='align-middle'><div class='btn character character_" . $i . "'>" . $value . '</div></td>';
                                        echo "<td id='type_$i' class='align-middle'>";
                                        switch ($list_types[$i]) {
                                                case '1': echo 'Main';
                                                break;
                                                case '2': echo 'Alt';
                                                break;
                                                default: echo 'Bot';
                                            }
                                        echo '</td>';
                                        echo "<td class='align-middle'>" . $list_total_earned[$i] . '</td>';
                                        echo "<td class='align-middle'>" . $list_total_spent[$i] . '</td>';
                                        echo "<td class='align-middle'>" . $list_last50_earned[$i] . '</td>';
                                        echo "<td class='align-middle'>" . $list_last50_spent[$i] . '</td>';
                                        echo "<td id='points_$i' class='align-middle'>" . ($list_last50_earned[$i] - $list_last50_spent[$i]) . '</td>';
                                        echo "<td class='align-middle'><button class='btn btn-sm btn-primary' id='compare_" . $i . "'>Compare</button></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br /><br />
                    </div>