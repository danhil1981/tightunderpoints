                    <div id="items" class="d-none table-responsive">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_items">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Drops From</th>
                                    <th scope="col">Points</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ($i = 0; $i < count($items_list); $i++) {
                                            $item = $items_list[$i];
                                            echo "<tr><td class='fit align-middle'><div class='btn item item_" . $item['id'] . "'>" . $item['name'] . '</div></td>';
                                            echo "<td class='align-middle'><div class='btn boss boss_" . $item['id_boss'] . "'>" . $item['name_boss'] . '</div></td>';
                                            echo "<td class='align-middle'>" . $item['value'] . '</td>';
                                            echo "<td class='fit align-middle'><a title='View " . $item['name'] . " on AllaClone' href='http://allaclone.p2002.com/item.php?id=" . $item['id'] . "' target='_blank' class='btn btn-light btn-sm'><i class='material-icons align-middle'>web</i></a></td>";
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>