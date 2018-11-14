<?php
    $this->session->userdata = array();

    if(isset($msg)) echo $msg;
    echo "<h1>Tight Underpoints</h1>";
    echo "<h2>Login</h2>";
    echo form_open('users/process_login');
    echo "User: ".form_input('user')."<br/>";
    echo "Password: ".form_password('password')."<br/>";
    echo form_submit('submit', 'Submit');
    echo form_close();

?>