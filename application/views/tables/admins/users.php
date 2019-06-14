                    <div id="users" class="d-none">
                        <div class="text-center mb-5">
                            <a title="New User" href="<?php echo site_url()?>users/show_insert/"
                                class="btn btn-success btn-sm"><i class='material-icons align-middle'>person_add</i></a>
                        </div>
                        <table class="table table-dark table-striped table-bordered table-hover table-sm text-center"
                            id="table_users">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Actions</th>
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
                                        echo "<td class='align-middle'><div class='btn-group'><a title='Modify " . $user['name'] . "' href='" . site_url() . 'users/show_modify/' . $user['id'] . "' class='btn btn-primary btn-sm'><i class='material-icons align-middle'>settings</i></a>";
                                        echo "<button title='Delete " . $user['name'] . "' data-env='User' data-title='" . $user['name'] . "' data-href='" . site_url() . 'users/delete/' . $user['id'] . "' data-toggle='modal' data-target='#modal_delete_confirmation' class='btn btn-danger btn-sm'><i class='material-icons align-middle'>delete</i></button></div></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>