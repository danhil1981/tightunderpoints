<?php

    echo "<h1>New player</h1>";
    echo anchor('users/admin_panel', 'Cancel', 'class="cancel"');
    echo "<br/><br/>";
    echo form_open_multipart('players/insert');
    echo "Name: ".form_input('name','','required')."<br/>";
    echo form_submit('submit', 'Submit');
    echo form_close();
    
?>
