                    <div id="items" class="d-none">
                        <div class="text-center mb-5">
                            <a href="<?php echo site_url()?>items/show_insert/"
                                class="btn btn-success btn-sm">New Item</a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_items">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Drops From</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($items_list); $i++) {
                                        $item = $items_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $item['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $item['name'] . '</td>';
                                        echo "<td class='align-middle'>" . $item['name_boss'] . '</td>';
                                        echo "<td class='align-middle'>" . $item['value'] . '</td>';
                                        echo "<td class='align-middle'><a href='http://allaclone.p2002.com/item.php?id=" . $item['id'] . "' target='_blank' class='btn btn-primary btn-sm'>Allaclone</a></td>";
                                        echo "<td class='align-middle'><button data-env='Item' data-title='" . $item['name'] . "' data-href='" . site_url() . 'items/delete/' . $item['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'items/show_modify/' . $item['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <a href="<?php echo site_url()?>items/show_insert/"
                                class="btn btn-success btn-sm">New Item</a>
                        </div>
                    </div>