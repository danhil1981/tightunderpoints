            <?php include 'assets/datatables.php';?>
            <script src="<?php echo base_url()?>assets/js/officer_panel.js">
            </script>
            <h1 class="text-center text-white">Officer Panel</h1>
            <?php include 'messages/message.php';?>
            <div class="row my-5" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <div class="btn-group">
                        <button id="button_points" class="btn btn-light btn-sm">Points</button>
                        <button id="button_timers" class="btn btn-light btn-sm">Timers</button>
                        <button id="button_attendance" class="btn btn-light btn-sm">Attendance</button>
                        <button id="button_players" class="btn btn-light btn-sm">Players</button>
                        <button id="button_characters" class="btn btn-light btn-sm">Characters</button>
                    </div>
                    <div class="btn-group">
                        <?php
                            if ($this->session->type < 2) {
                                echo anchor('admins', 'Admin Panel', "class='btn btn-success btn-sm'");
                            }
                        ?>
                        <?php echo anchor('members', 'Member Panel', "class='btn btn-success btn-sm'");?>
                        <a href="<?php echo site_url()?>"
                            class="btn btn-danger btn-sm">Logout</a>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-8 offset-2" id="tables">
                    <?php include 'tables/compare.php';?>
                    <?php include 'tables/winner.php';?>
                    <?php include 'tables/points.php';?>
                    <?php include 'tables/officers/timers.php';?>
                    <?php include 'tables/officers/attendance.php';?>
                    <?php include 'tables/players.php'?>
                    <?php include 'tables/characters.php'?>
                </div>
            </div>
            <div class="modal fade" id="modal_character" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="title_character"></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center" id="content_character">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_boss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="title_boss"></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center" id="content_boss">
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'modals/delete_confirmation.php';?>
            <?php
                if (isset($this->session->table)) {
                    echo "<script>show('" . $this->session->table . "')</script>";
                } else {
                    echo "<script>show('points')</script>";
                }
