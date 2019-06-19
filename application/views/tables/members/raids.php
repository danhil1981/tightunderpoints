                    <div id="raids" class="d-none table-responsive">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_raids">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ($i = 0; $i < count($raids_list); $i++) {
                                            $raid = $raids_list[$i];
                                            echo "<tr><td class='align-middle'>" . $raid['date'] . '</td>';
                                            echo "<td class='align-middle'>" . date('D j M, Y', strtotime($raid['date'])) . '</td>';
                                            echo "<td class='align-middle'>" . $raid['description'] . '</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>