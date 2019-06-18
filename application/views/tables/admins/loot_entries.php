                    <div id="loot" class="d-none">
                        <div class="text-center mb-5">
                            <a title="New Loot Entry" href="<?php echo site_url()?>loot/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>add_shopping_cart</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_loot">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Drop</th>
                                    <th scope="col">Character</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($loot_list); $i++) {
                                        $loot_entry = $loot_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $loot_entry['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $loot_entry['name_drop'] . '</td>';
                                        echo "<td class='align-middle'>" . $loot_entry['name_character'] . '</td>';
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $loot_entry['name_drop'] . ' - ' . $loot_entry['name_character'] . "' href='" . site_url() . 'loot/show_modify/' . $loot_entry['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $loot_entry['name_drop'] . ' - ' . $loot_entry['name_character'] . "' data-env='Loot Entry' data-title='" . $loot_entry['name_drop'] . ' - ' . $loot_entry['name_character'] . "' data-href='" . site_url() . 'loot/delete/' . $loot_entry['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>