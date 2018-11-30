<h1 class='text-center text-white'>Admin Panel</h1>
<br/><br/>

<?php if(isset($msg)) echo $msg ?>

<br/><br/>

<div class="row">
    <div class="col-10 offset-1">
        <button onclick='show_users()' id='button_users' class="btn btn-primary">Users</button>
        <button onclick='show_players()' id='button_players' class="btn">Players</button>
        <button onclick='show_characters()' id='button_characters' class="btn">Characters</button>
        <button onclick='show_raids()' id='button_raids' class="btn">Raids</button>
        <button onclick='show_events()' id='button_events' class="btn">Events</button>
        <button onclick='show_bosses()' id='button_bosses' class="btn">Bosses</button>
        <button onclick='show_items()' id='button_items' class="btn">Items</button>
        <button onclick='show_drops()' id='button_drops' class="btn">Drops</button>
        <button onclick='show_attendance()' id='button_attendance' class="btn">Attendence</button>
        <button onclick='show_loots()' id='button_loots' class="btn">Loots</button>

        <?php echo anchor('users/admin_panel', 'Refresh', 'class="btn btn-success"');?>

        <a href='<?php echo site_url()?>' class='btn btn-danger'>Logout</a>
        <br/><br/>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-2">
        <div id='users' class="visible">
            <table class='table-dark table-responsive'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <?php
                    for ($i = 0; $i < count($users_list); $i++) {
                        $user = $users_list[$i];
                
                        echo "<tr><td>".$user['id']."</td>";
                        echo "<td>".$user['name']."</td>";
                        echo "<td><a href='".site_url()."/users/delete/".$user['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "<td><a href='".site_url()."/users/show_modify/".$user['id']."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                    }
                ?>
            </table>

        <div id='players' class="invisible">
            <table class='table-dark'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <?php
                    for ($i = 0; $i < count($players_list); $i++) {
                        $player = $players_list[$i];
                
                        echo "<tr><td>".$player['id']."</td>";
                        echo "<td>".$player['name']."</td>";
                        echo "<td><a href='".site_url()."/players/delete/".$player['id']."' class='delete'>Delete</a></td>";
                        echo "<td><a href='".site_url()."/players/show_modify/".$player['id']."' class='modify'>Modify</a></td></tr>";
                    }
                ?>
            </table>
            <br/>
            <a href='<?php echo site_url()?>/players/show_insert/' class='insert'>New</a>
            <br/><br/>
        </div>
    </div>
</div>
