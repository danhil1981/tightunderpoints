            <?php include 'assets/datatables.php';?>
            <script src="<?php echo base_url()?>assets/js/member_panel.js">
            </script>
            <h1 class="text-center text-white">Member Panel</h1>
            <?php include 'messages/message.php';?>
            <div class="row my-5" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <div class="btn-group">
                        <button id="button_points" class="btn btn-light btn-sm">Points</button>
                        <button id="button_loot" class="btn btn-light btn-sm">Loot</button>
                        <button id="button_roster" class="btn btn-light btn-sm">Roster</button>
                        <button id="button_bosses" class="btn btn-light btn-sm">Bosses</button>
                        <button id="button_items" class="btn btn-light btn-sm">Items</button>
                        <button id="button_raids" class="btn btn-light btn-sm">Raids</button>
                        <button id="button_events" class="btn btn-light btn-sm">Events</button>
                        <?php
                            if ($this->session->type < 2) {
                                echo anchor('admins', 'Admin Panel', "class='btn btn-success btn-sm'");
                            }
                        ?>
                        <?php
                            if ($this->session->type < 3) {
                                echo anchor('officers', 'Officer Panel', "class='btn btn-success btn-sm'");
                            }
                        ?>
                        <a href="<?php echo site_url()?>"
                            class="btn btn-danger btn-sm">Logout</a>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-8 offset-2" id="tables">
                    <?php
                        include 'tables/compare.php';
                        include 'tables/winner.php';
                        include 'tables/points.php';
                        include 'tables/members/loot.php';
                        include 'tables/members/roster.php';
                        include 'tables/members/bosses.php';
                        include 'tables/members/items.php';
                        include 'tables/members/raids.php';
                        include 'tables/members/events.php';
                    ?>
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
            <div class="modal fade" id="modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="title_item"></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center" id="content_item">
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if (isset($this->session->table)) {
                    echo "<script>show('.$this->session->table.')</script>";
                } else {
                    echo "<script>show('points')</script>";
                }
