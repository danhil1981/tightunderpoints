                    <div id="points" class="d-none table-responsive">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_points">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Name</th>
                                    <th scope="col" class="align-middle">Type</th>
                                    <th scope="col" class="align-middle">All Time Earned</th>
                                    <th scope="col" class="align-middle">All Time Spent</th>
                                    <th scope="col" class="align-middle">Earned last 50 days</th>
                                    <th scope="col" class="align-middle">Spent last 50 days</th>
                                    <th scope="col" class="align-middle">Available Points</th>
                                    <th scope="col" class="align-middle"></th>
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
                                        echo "<td class='fit align-middle'><button title='Compare' class='btn btn-sm btn-success' id='compare_" . $i . "'><i class='material-icons align-middle'>compare_arrows</i></button></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>