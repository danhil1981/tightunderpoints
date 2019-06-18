                    <div id="raids" class="d-none">
                        <div class="text-center mb-5">
                            <a title="New Raid" href="<?php echo site_url()?>raids/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>library_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_raids">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($raids_list); $i++) {
                                        $raid = $raids_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $raid['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $raid['date'] . '</td>';
                                        echo "<td class='align-middle'>" . $raid['description'] . '</td>';
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $raid['description'] . "' href='" . site_url() . 'raids/show_modify/' . $raid['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $raid['description'] . "' data-env='Raid' data-title='" . $raid['description'] . "' data-href='" . site_url() . 'raids/delete/' . $raid['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>