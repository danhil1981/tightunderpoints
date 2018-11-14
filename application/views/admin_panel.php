<?php

    echo "<h1>Tight Underpoints</h1>";
    echo "<br/><br/>";
    if(isset($msg)) echo $msg;
    echo "<br/><br/>";
    echo "<button onclick='show_players()' id='button_players'>Players</button>";
    echo "<button onclick='show_raids()' id='button_raids'>Raids</button>";
    echo "<button onclick='show_items()' id='button_items'>Items</button>";
    echo "<button onclick='show_encounters()' id='button_encounters'>Encounters</button>";
    echo "<a href='".site_url()."' class='logout'>Logout</a>";
    echo "<br/><br/>";
            
?>
