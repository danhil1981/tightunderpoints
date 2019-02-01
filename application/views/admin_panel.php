            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/admin_panel.js"></script>
            <h1 class='text-center text-white'>Admin Panel</h1>
            <br/><br/>
            <div class="row" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($this->session->msg)) echo $this->session->msg ?>
                    <br/><br/>
                    <button onclick='show("users")' id='button_users' class="btn btn-primary btn-sm">Users</button>
                    <button onclick='show("players")' id='button_players' class="btn btn-light btn-sm">Players</button>
                    <button onclick='show("characters")' id='button_characters' class="btn btn-light btn-sm">Characters</button>
                    <button onclick='show("bosses")' id='button_bosses' class="btn btn-light btn-sm">Bosses</button>
                    <button onclick='show("items")' id='button_items' class="btn btn-light btn-sm">Items</button>
                    <button onclick='show("raids")' id='button_raids' class="btn btn-light btn-sm">Raids</button>
                    <button onclick='show("events")' id='button_events' class="btn btn-light btn-sm">Events</button>
                    <button onclick='show("drops")' id='button_drops' class="btn btn-light btn-sm">Drops</button>
                    <button onclick='show("attendance")' id='button_attendance' class="btn btn-light btn-sm">Attendance</button>
                    <button onclick='show("loot")' id='button_loot' class="btn btn-light btn-sm">Loot</button>
                    <?php echo anchor('admins', 'Refresh', 'class="btn btn-success btn-sm"');?>
                    <a href='<?php echo site_url()?>' class='btn btn-danger btn-sm'>Logout</a>
                    <?php echo anchor('officers', 'Officer Panel', 'class="btn btn-success btn-sm"');?>
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
                                        echo "<td>";
                                            switch($character['type']) {
                                                case "1": echo "Main";
                                                break;
                                                case "2": echo "Alt";
                                                break;
                                                default: echo "Bot";
                                            }
                                        echo "</td>";
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
                    <div id='bosses' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_bosses">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Respawn Time</th>
                                    <th scope="col">Variance</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($bosses_list); $i++) {
                                        $boss = $bosses_list[$i];
                                        echo "<tr><th scope='row'>".$boss['id']."</th>";
                                        echo "<td>".$boss['name']."</td>";
                                        echo "<td>".$boss['respawn']."</td>";
                                        echo "<td>".$boss['variance']."</td>";
                                        echo "<td>".$boss['value']."</td>";
                                        echo "<td><a href='".site_url()."/bosses/delete/".$boss['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/bosses/show_modify/".$boss['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/bosses/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                    <div id='items' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_items">
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
                                        echo "<tr><th scope='row'>".$item['id']."</th>";
                                        echo "<td>".$item['name']."</td>";
                                        echo "<td>".$item['name_boss']."</td>";
                                        echo "<td>".$item['value']."</td>";
                                        echo "<td><a href='http://allaclone.p2002.com/item.php?id=".$item['id']."' target='_blank' class='btn btn-primary btn-sm'>Allaclone</a></td>";
                                        echo "<td><a href='".site_url()."/items/delete/".$item['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/items/show_modify/".$item['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/items/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                    <div id='raids' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_raids">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($raids_list); $i++) {
                                        $raid = $raids_list[$i];
                                        echo "<tr><th scope='row'>".$raid['id']."</th>";
                                        echo "<td>".$raid['date']."</td>";
                                        echo "<td>".$raid['description']."</td>";
                                        echo "<td><a href='".site_url()."/raids/delete/".$raid['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/raids/show_modify/".$raid['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/raids/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                    <div id='events' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_events">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Raid</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($events_list); $i++) {
                                        $event = $events_list[$i];
                                        echo "<tr><th scope='row'>".$event['id']."</th>";
                                        echo "<td>".$event['timestamp']."</td>";
                                        echo "<td>".$event['name_boss']."</td>";
                                        echo "<td>".$event['description_raid']."</td>";
                                        echo "<td><a href='".site_url()."/events/delete/".$event['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/events/show_modify/".$event['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/events/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                     <div id='drops' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_drops">
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
                                        echo "<tr><th scope='row'>".$drop['id']."</th>";
                                        echo "<td>".$drop['name_event']."</td>";
                                        echo "<td>".$drop['name_item']."</td>";
                                        echo "<td><a href='".site_url()."/drops/delete/".$drop['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/drops/show_modify/".$drop['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/drops/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                    <div id='attendance' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_attendance">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Character</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($attendance_list); $i++) {
                                        $attendance_entry = $attendance_list[$i];
                                        echo "<tr><th scope='row'>".$attendance_entry['id']."</th>";
                                        echo "<td>".$attendance_entry['name_event']."</td>";
                                        echo "<td>".$attendance_entry['name_character']."</td>";
                                        echo "<td><a href='".site_url()."/attendance/delete/".$attendance_entry['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/attendance/show_modify/".$attendance_entry['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/attendance/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                    <div id='loot' style='display: none;'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_loot">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Drop</th>
                                    <th scope="col">Character</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($loot_list); $i++) {
                                        $loot_entry = $loot_list[$i];
                                        echo "<tr><th scope='row'>".$loot_entry['id']."</th>";
                                        echo "<td>".$loot_entry['name_drop']."</td>";
                                        echo "<td>".$loot_entry['name_character']."</td>";
                                        echo "<td><a href='".site_url()."/loot/delete/".$loot_entry['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                                        echo "<td><a href='".site_url()."/loot/show_modify/".$loot_entry['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/>
                        <a href='<?php echo site_url()?>/loot/show_insert/' class='btn btn-success btn-sm'>New</a>
                        <br/><br/>
                    </div>
                </div>
            </div>

            <?php
                if (isset($this->session->table)) {
                    echo "<script>show('".$this->session->table."');</script>";
                }
            ?>
