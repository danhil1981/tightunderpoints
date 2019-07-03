                    <div id="items" class="d-none table-responsive">
                        <div class="text-center mb-5">
                            <a title="New Item" href="<?php echo site_url()?>items/show_insert/"
                                class="btn btn-primary btn-sm"><i class='material-icons align-middle'>library_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_items">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
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
                                        echo "<tr><th scope='row' class='fit align-middle'>" . $item['id_item'] . '</th>';
                                        echo "<td class='align-middle'>" . $item['name'] . '</td>';
                                        echo "<td class='align-middle'>" . $item['name_boss'] . '</td>';
                                        echo "<td class='align-middle'>" . $item['value'] . '</td>';
                                        echo "<td class='fit align-middle'><div class='btn-group'><a title='View " . $item['name'] . " on AllaClone' href='http://allaclone.p2002.com/item.php?id=" . $item['id_item'] . "' target='_blank' class='btn btn-light btn-sm'><i class='material-icons align-middle'>web</i></a>";
                                        echo "<a title='Modify " . $item['name'] . "' href='" . site_url() . 'items/show_modify/' . $item['id'] . "' class='btn btn-success btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $item['name'] . "' data-env='Item' data-title='" . $item['name'] . "' data-href='" . site_url() . 'items/delete/' . $item['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>