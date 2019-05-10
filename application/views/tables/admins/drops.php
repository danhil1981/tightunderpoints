                    <div id="drops" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_drops">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($drops_list); $i++) {
                                        $drop = $drops_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $drop['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $drop['name_event'] . '</td>';
                                        echo "<td class='align-middle'>" . $drop['name_item'] . '</td>';
                                        echo "<td class='align-middle'><button data-env='Drop Entry' data-title='" . $drop['id'] . "' data-href='" . site_url() . 'drops/delete/' . $drop['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'drops/show_modify/' . $drop['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br />
                        <a href="<?php echo site_url()?>drops/show_insert/"
                            class="btn btn-success btn-sm">New Drop</a>
                        <br /><br />
                    </div>