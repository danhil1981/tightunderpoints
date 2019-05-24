                    <div id="loot" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_loot">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Character</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($loot_list); $i++) {
                                        $loot_entry = $loot_list[$i];
                                        echo "<tr><td class='align-middle'>" . $loot_entry['timestamp'] . '</td>';
                                        echo "<td class='align-middle'>" . date('D j M, Y', strtotime($loot_entry['timestamp'])) . '</td>';
                                        echo "<td class='align-middle'><div class='btn item item_" . $drop_list[$loot_entry['id_drop']] . "'>" . $loot_entry['name_item'] . '</div></td>';
                                        echo "<td class='align-middle'><div class='btn character character_" . $loot_entry['id_character'] . "'>" . $loot_entry['name_character'] . '</div></td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>