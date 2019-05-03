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
                    <?php include 'tables/table_users.php'?>
                    <?php include 'tables/table_players.php'?>
                    <?php include 'tables/table_characters.php'?>
                    <?php include 'tables/table_bosses.php'?>
                    <?php include 'tables/table_items.php'?>
                    <?php include 'tables/table_raids.php'?>
                    <?php include 'tables/table_events.php'?>
                    <?php include 'tables/table_drops.php'?>
                    <?php include 'tables/table_attendance.php'?>
                    <?php include 'tables/table_loot.php'?>
                </div>
            </div>
            <div class="modal fade" id="modal_delete_confirmation" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="exampleModalLabel">EMPTY</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <form id="form_delete_confirmation" action="EMPTY" method="GET">
                                <button type="submit" class="btn btn-danger d-inline-block">Delete</button>
                                <button type="button" class="btn btn-warning d-inline-block"
                                    data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if (isset($this->session->table)) {
                    echo "<script>show('" . $this->session->table . "')</script>";
                } else {
                    echo "<script>show('users')</script>";
                }
