                    <div id="bosses" class="d-none">
                        <div class="text-center mb-5">
                            <a title="New Boss" href="<?php echo site_url()?>bosses/show_insert/"
                                class="btn btn-success btn-sm"><i class='material-icons align-middle'>library_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_bosses">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Respawn Time</th>
                                    <th scope="col">Variance</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($bosses_list); $i++) {
                                        $boss = $bosses_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $boss['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $boss['name'] . '</td>';
                                        echo "<td class='align-middle'>" . $boss['respawn'] . '</td>';
                                        echo "<td class='align-middle'>" . $boss['variance'] . '</td>';
                                        echo "<td class='align-middle'>" . $boss['value'] . '</td>';
                                        echo '</td>';
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $boss['name'] . "' href='" . site_url() . 'bosses/show_modify/' . $boss['id'] . "' class='btn btn-primary btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $boss['name'] . "' data-env='Boss' data-title='" . $boss['name'] . "' data-href='" . site_url() . 'bosses/delete/' . $boss['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>