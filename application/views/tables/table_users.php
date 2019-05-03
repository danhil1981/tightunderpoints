                    <div id="users" class="d-none">
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_users">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($users_list); $i++) {
                                        $user = $users_list[$i];
                                        echo "<tr><th scope='row' class='align-middle'>" . $user['id'] . '</th>';
                                        echo "<td class='align-middle'>" . $user['name'] . '</td>';
                                        echo "<td class='align-middle'>";
                                        switch ($user['type']) {
                                            case '1': echo 'Admin'; break;
                                            case '2': echo 'Officer'; break;
                                            default: echo 'Member';
                                        }
                                        echo '</td>';
                                        echo "<td class='align-middle'><button data-env='User' data-title='" . $user['name'] . "' data-href='" . site_url() . 'users/delete/' . $user['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'>Delete</button></td>";
                                        echo "<td class='align-middle'><a href='" . site_url() . 'users/show_modify/' . $user['id'] . "' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br />
                        <a href="<?php echo site_url()?>users/show_insert/"
                            class="btn btn-success btn-sm">New User</a>
                        <br /><br />
                    </div>