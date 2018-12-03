            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/scripts.js"></script>

            <h1 class='text-center text-white'>Admin Panel</h1>
            <br/><br/>

            <div class="row">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($msg)) echo $msg ?>
                    <br/><br/>
                    <button onclick='show("users")' id='button_users' class="btn btn-primary btn-sm">Users</button>
                    <button onclick='show("players")' id='button_players' class="btn btn-light btn-sm">Players</button>
                    <button onclick='show("characters")' id='button_characters' class="btn btn-light btn-sm">Characters</button>
                    <button onclick='show("raids")' id='button_raids' class="btn btn-light btn-sm">Raids</button>
                    <button onclick='show("events")' id='button_events' class="btn btn-light btn-sm">Events</button>
                    <button onclick='show("bosses")' id='button_bosses' class="btn btn-light btn-sm">Bosses</button>
                    <button onclick='show("items")' id='button_items' class="btn btn-light btn-sm">Items</button>
                    <button onclick='show("drops")' id='button_drops' class="btn btn-light btn-sm">Drops</button>
                    <button onclick='show("attendance")' id='button_attendance' class="btn btn-light btn-sm">Attendence</button>
                    <button onclick='show("loots")' id='button_loots' class="btn btn-light btn-sm">Loots</button>
                    <?php echo anchor('users/admin_panel', 'Refresh', 'class="btn btn-success btn-sm"');?>
                    <a href='<?php echo site_url()?>' class='btn btn-danger btn-sm'>Logout</a>
                    <br/><br/>
                </div>
            </div>

            <div class="row">
                <div class="col-8 offset-2">
                    <div id='users'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_users">
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
                                
                                        echo "<tr><th scope='row'>".$user['id']."</th>";
                                        echo "<td>".$user['name']."</td>";
                                        echo "<td>".$user['type']."</td>";
                                        echo "<td><a href='".site_url()."/users/delete/".$user['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/users/show_modify/".$user['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/users/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>

                    <div id='players' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_players">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($players_list); $i++) {
                                        $player = $players_list[$i];
                                
                                        echo "<tr><th scope='row'>".$player['id']."</th>";
                                        echo "<td>".$player['name']."</td>";
                                        echo "<td><a href='".site_url()."/players/delete/".$player['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/players/show_modify/".$player['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/players/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>

                    <div id='characters' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_characters">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Player</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($characters_list); $i++) {
                                        $character = $characters_list[$i];
                                
                                        echo "<tr><th scope='row'>".$character['id']."</th>";
                                        echo "<td>".$character['name']."</td>";
                                        echo "<td>".$character['level']."</td>";
                                        echo "<td>".$character['class']."</td>";
                                        echo "<td>".$character['type']."</td>";
                                        echo "<td>".$character['name_player']."</td>";
                                        echo "<td><a href='".site_url()."/characters/delete/".$character['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/characters/show_modify/".$character['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/characters/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                </div>
            </div>

            <?php
                if (isset($table_to_show)) {
                    echo "<script>show('".$table_to_show."');</script>";
                }
            ?>
