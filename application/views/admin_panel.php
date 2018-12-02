<h1 class='text-center text-white'>Admin Panel</h1>
<br/><br/>

<div class="row">
    <div class="col-10 offset-1 text-center">
        <?php if(isset($msg)) echo $msg ?>
        <br/><br/>
        <button onclick='show("users")' id='button_users' class="btn btn-primary">Users</button>
        <button onclick='show("players")' id='button_players' class="btn">Players</button>
        <button onclick='show("characters")' id='button_characters' class="btn">Characters</button>
        <button onclick='show("raids")' id='button_raids' class="btn">Raids</button>
        <button onclick='show("events")' id='button_events' class="btn">Events</button>
        <button onclick='show("bosses")' id='button_bosses' class="btn">Bosses</button>
        <button onclick='show("items")' id='button_items' class="btn">Items</button>
        <button onclick='show("drops")' id='button_drops' class="btn">Drops</button>
        <button onclick='show("attendance")' id='button_attendance' class="btn">Attendence</button>
        <button onclick='show("loots")' id='button_loots' class="btn">Loots</button>
        <?php echo anchor('users/admin_panel', 'Refresh', 'class="btn btn-success"');?>
        <a href='<?php echo site_url()?>' class='btn btn-danger'>Logout</a>
        <br/><br/>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-2">
        <div id='users'>
            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center'>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
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
            </table>
            <br/>
            <a href='<?php echo site_url()?>/users/show_insert/' class='btn btn-success btn-sm'>New</a>
            <br/><br/>
        </div>

        <div id='players' style='display: none;'>
            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center'>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <?php
                    for ($i = 0; $i < count($players_list); $i++) {
                        $player = $players_list[$i];
                
                        echo "<tr><th scope='row'>".$player['id']."</th>";
                        echo "<td>".$player['name']."</td>";
                        echo "<td><a href='".site_url()."/players/delete/".$player['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "<td><a href='".site_url()."/players/show_modify/".$player['id']."' class='btn btn-warning btn-sm''>Modify</a></td></tr>";
                    }
                ?>
            </table>
            <br/>
            <a href='<?php echo site_url()?>/players/show_insert/' class='btn btn-success btn-sm'>New</a>
            <br/><br/>
        </div>

        <div id='characters' style='display: none;'>
            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center'>
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
