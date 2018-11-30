<?php

    echo "<h1 class='text-center text-white'>Admin Panel</h1>";
    echo "<br/><br/>";
    if(isset($msg)) echo $msg;
    echo "<br/><br/>";
    echo "<button onclick='show_players()' id='button_players'>Players</button>";
    echo "<button onclick='show_raids()' id='button_raids'>Raids</button>";
    echo "<button onclick='show_items()' id='button_items'>Items</button>";
    echo "<button onclick='show_encounters()' id='button_encounters'>Encounters</button>";
    echo anchor('users/admin_panel', 'Refresh', 'class="refresh"');
    echo "<a href='".site_url()."' class='logout'>Logout</a>";
    echo "<br/><br/>";


    echo "<div id='players'>";
    echo "<table class='table-dark'><thead><tr><th>Id</th><th>Name</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>";
    for ($i = 0; $i < count($players_list); $i++) {
        $player = $players_list[$i];
        
        echo "<tr><td>".$player['id']."</td>";
        echo "<td>".$player['name']."</td>";
        echo "<td><a href='".site_url()."/players/delete/".$player['id']."' class='delete'>Delete</a></td>";
        echo "<td><a href='".site_url()."/players/show_modify/".$player['id']."' class='modify'>Modify</a></td></tr>";
    }
    echo "</table><br/>";
    echo "<a href='".site_url()."/players/show_insert/' class='insert'>New</a>";
    echo "<br/><br/>";
    echo "</div>";
            
?>
