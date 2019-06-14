                    <div id="drops" class="d-none">
                        <div class="text-center mb-5">
                            <a title="New Drop Entry" href="<?php echo site_url()?>drops/show_insert/"
                                class="btn btn-success btn-sm"><i class='material-icons align-middle'>add_shopping_cart</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_drops">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($drops_list); $i++) {
                                        $drop = $drops_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $drop['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $drop['name_event'] . '</td>';
                                        echo "<td class='align-middle'>" . $drop['name_item'] . '</td>';
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $drop['name_event'] . ' - ' . $drop['name_item'] . "' href='" . site_url() . 'drops/show_modify/' . $drop['id'] . "' class='btn btn-primary btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $drop['name_event'] . ' - ' . $drop['name_item'] . "' data-env='Drop Entry' data-title='" . $drop['name_event'] . ' - ' . $drop['name_item'] . "' data-href='" . site_url() . 'drops/delete/' . $drop['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>