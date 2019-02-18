            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/member_panel.js"></script>
            <h1 class='text-center text-white'>Member Panel</h1>
            <br/><br/>
            <div class="row" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($this->session->msg)) echo $this->session->msg ?>
                    <br/><br/>
                    <button id='button_points' class="btn btn-light btn-sm">Points</button>
                    <button id='button_loot' class="btn btn-light btn-sm">Loot</button>
                    <button id='button_roster' class="btn btn-light btn-sm">Roster</button>
                    <button id='button_bosses' class="btn btn-light btn-sm">Bosses</button>
                    <button id='button_items' class="btn btn-light btn-sm">Items</button>
                    <button id='button_raids' class="btn btn-light btn-sm">Raids</button>
                    <button id='button_events' class="btn btn-light btn-sm">Events</button>
                    <a href='<?php echo site_url()?>' class='btn btn-danger btn-sm'>Logout</a>
                    <?php if($this->session->type < 2) echo anchor('admins', 'Admin Panel', 'class="btn btn-success btn-sm"') ?>
                    <?php if($this->session->type < 3) echo anchor('officers', 'Officer Panel', 'class="btn btn-success btn-sm"') ?>
                    <br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-4 d-none" id='compare'>
                    <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_compare">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Available Points</th>
                            </tr>
                        </thead>
                        <tbody id="compare_tbody">
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="col-4 offset-4 d-none" id="winner">
                    <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_winner">
                        <tbody id="winner_tbody">
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="col-8 offset-2" id="tables">
                    <div id='points' class='d-none'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_points">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">All Time Earned</th>
                                    <th scope="col">All Time Spent</th>
                                    <th scope="col">Earned last 50 days</th>
                                    <th scope="col">Spent last 50 days</th>
                                    <th scope="col">Available Points</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($list_names as $i => $value) {
                                        echo "<tr><td id='name_$i'>".$value."</td>";
                                        echo "<td id='type_$i'>";
                                            switch($list_types[$i]) {
                                                case "1": echo "Main";
                                                break;
                                                case "2": echo "Alt";
                                                break;
                                                default: echo "Bot";
                                            }
                                        echo "</td>";
                                        echo "<td>".$list_total_earned[$i]."</td>";
                                        echo "<td>".$list_total_spent[$i]."</td>";
                                        echo "<td>".$list_last50_earned[$i]."</td>";
                                        echo "<td>".$list_last50_spent[$i]."</td>";
                                        echo "<td id='points_$i'>".($list_last50_earned[$i]-$list_last50_spent[$i])."</td>";
                                        echo "<td><button class='btn btn-sm btn-primary' id='compare_".$i."'>Compare</button></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
                    <div id='loot' class='d-none'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_loot">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Character</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($loot_list); $i++) {
                                        $loot_entry = $loot_list[$i];
                                        echo "<tr><td class='align-middle'>".$loot_entry['timestamp']."</td>";
                                        echo "<td class='align-middle'>".date('D j M, Y',strtotime($loot_entry['timestamp']))."</td>";
                                        echo "<td class='align-middle'>".$loot_entry['name_item']."</td>";
                                        echo "<td class='align-middle'>".$loot_entry['name_character']."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
                    <div id='roster' class='d-none'>
                            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_roster">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Player</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 0; $i < count($characters_list); $i++) {
                                            $character = $characters_list[$i];
                                            echo "<tr><td class='align-middle'>".$character['name']."</td>";
                                            echo "<td class='align-middle'>".$character['level']."</td>";
                                            echo "<td class='align-middle'>".$character['class']."</td>";
                                            echo "<td class='align-middle'>";
                                                switch($character['type']) {
                                                    case "1": echo "Main";
                                                    break;
                                                    case "2": echo "Alt";
                                                    break;
                                                    default: echo "Bot";
                                                }
                                            echo "</td>";
                                            echo "<td class='align-middle'>".$character['name_player']."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br/><br/>
                        </div>
                        <div id='bosses' class='d-none'>
                            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_bosses">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th></th>
                                        <th scope="col">Respawn Time</th>
                                        <td></th>
                                        <th scope="col">Variance</th>
                                        <th scope="col">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 0; $i < count($bosses_list); $i++) {
                                            $boss = $bosses_list[$i];
                                            echo "<tr><td class='align-middle'>".$boss['name']."</td>";
                                            echo "<td>".$boss['respawn']."</td>";
                                            echo "<td class='align-middle'>";
                                                $hms = explode(":", $boss['respawn']);
                                                if ($hms[0] < 24) {
                                                    echo $hms[0]." hours";
                                                }
                                                else {
                                                    echo ($hms[0]/24)." days";
                                                }
                                            echo "</td>";
                                            echo "<td>".$boss['variance']."</td>";
                                            echo "<td class='align-middle'>";
                                                $hms = explode(":", $boss['variance']);
                                                
                                                if ($hms[0] < 24) {
                                                    if ($hms[0] == 0) {
                                                    echo "none";
                                                    }
                                                    else {
                                                        echo intval($hms[0])." hours";
                                                    }  
                                                }
                                                else {
                                                    echo ($hms[0]/24)." days";
                                                }
                                            echo "</td>";
                                            echo "<td class='align-middle'>".$boss['value']."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br/><br/>
                        </div>
                        <div id='items' class='d-none'>
                            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_items">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Drops From</th>
                                        <th scope="col">Points</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 0; $i < count($items_list); $i++) {
                                            $item = $items_list[$i];
                                            echo "<tr><td class='align-middle'>".$item['name']."</td>";
                                            echo "<td class='align-middle'>".$item['name_boss']."</td>";
                                            echo "<td class='align-middle'>".$item['value']."</td>";
                                            echo "<td class='align-middle'><a href='http://allaclone.p2002.com/item.php?id=".$item['id']."' target='_blank' class='btn btn-primary btn-sm'>Allaclone</a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br/><br/>
                        </div>
                        <div id='raids' class='d-none'>
                            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_raids">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 0; $i < count($raids_list); $i++) {
                                            $raid = $raids_list[$i];
                                            echo "<tr><td class='align-middle'>".$raid['date']."</td>";
                                            echo "<td class='align-middle'>".date('D j M, Y',strtotime($raid['date']))."</td>";
                                            echo "<td class='align-middle'>".$raid['description']."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br/><br/>
                        </div>
                        <div id='events' class='d-none'>
                            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_events">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Boss</th>
                                        <th scope="col">Raid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 0; $i < count($events_list); $i++) {
                                            $event = $events_list[$i];
                                            echo "<tr><td class='align-middle'>".$event['timestamp']."</td>";
                                            echo "<td class='align-middle'>".date('D j M, Y',strtotime($event['timestamp']))."</td>";
                                            echo "<td class='align-middle'>".$event['name_boss']."</td>";
                                            echo "<td class='align-middle'>";
                                            if (!isset($event['description_raid'])) {
                                                echo "-- not part of a raid --";
                                            }
                                            else {
                                                echo $event['description_raid'];
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br/><br/>
                        </div>
                    </div>
            </div>
            <?php 
                if(isset($this->session->table)) {
                    echo "<script>show('".$this->session->table."')</script>";
                }
                else {
                    echo "<script>show('points')</script>";
                }
            ?>