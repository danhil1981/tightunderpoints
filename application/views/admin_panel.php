            <link rel="stylesheet" type="text/css"
                href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css"
                href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/admin_panel.js">
            </script>
            <h1 class="text-center text-white">Admin Panel</h1>
            <br /><br />
            <div class="row" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <?php
                        if (isset($this->session->msg)) {
                            echo $this->session->msg;
                        } ?>
                    <br /><br />
                    <button id="button_users" class="btn btn-light btn-sm">Users</button>
                    <button id="button_players" class="btn btn-light btn-sm">Players</button>
                    <button id="button_characters" class="btn btn-light btn-sm">Characters</button>
                    <button id="button_bosses" class="btn btn-light btn-sm">Bosses</button>
                    <button id="button_items" class="btn btn-light btn-sm">Items</button>
                    <button id="button_raids" class="btn btn-light btn-sm">Raids</button>
                    <button id="button_events" class="btn btn-light btn-sm">Events</button>
                    <button id="button_drops" class="btn btn-light btn-sm">Drops</button>
                    <button id="button_attendance" class="btn btn-light btn-sm">Attendance</button>
                    <button id="button_loot" class="btn btn-light btn-sm">Loot</button>
                    <?php echo anchor('officers', 'Officer Panel', "class='btn btn-success btn-sm'");?>
                    <?php echo anchor('members', 'Member Panel', "class='btn btn-success btn-sm'");?>
                    <a href="<?php echo site_url()?>"
                        class="btn btn-danger btn-sm">Logout</a>
                    <br /><br />
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-2" id="tables">
                    <?php include 'tables/users.php'?>
                    <?php include 'tables/players.php'?>
                    <?php include 'tables/characters.php'?>
                    <?php include 'tables/bosses.php'?>
                    <?php include 'tables/items.php'?>
                    <?php include 'tables/raids.php'?>
                    <?php include 'tables/events.php'?>
                    <?php include 'tables/drops.php'?>
                    <?php include 'tables/attendance.php'?>
                    <?php include 'tables/loot.php'?>
                </div>
            </div>
            <?php include 'modals/delete_confirmation.php';?>
            <?php
                if (isset($this->session->table)) {
                    echo "<script>show('" . $this->session->table . "')</script>";
                } else {
                    echo "<script>show('users')</script>";
                }
