<?php

    echo "<h1>Modify Player</h1>";
    echo anchor('users/admin_panel', 'Cancel', 'class="cancel"');
    echo "<br/><br/>";
    echo form_open_multipart('players/modify');
    echo "Name: ".form_input('name',$player['name'],'required')."<br/>";
    echo form_hidden('id',$player['id']);
    echo form_submit('submit', 'Submit');
    echo form_close();
    
?>
