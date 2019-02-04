            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/officer_panel.js"></script>
            <h1 class='text-center text-white'>Officer Panel</h1>
            <br/><br/>
            <div class="row" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($this->session->msg)) echo $this->session->msg ?>
                    <br/><br/>
                    <button id='button_points' class="btn btn-light btn-sm">Points</button>
                    <button id='button_timers' class="btn btn-light btn-sm">Timers</button>
                    <button id='button_attendance' class="btn btn-light btn-sm">Attendance</button>
                    <a href='<?php echo site_url()?>' class='btn btn-danger btn-sm'>Logout</a>
                    <?php if($this->session->type == "Admin") echo anchor('admins', 'Admin Panel', 'class="btn btn-success btn-sm"') ?>
                    <br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-4 d-none" id='compare'>
                    <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_compare">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Available Points</th>
                            </tr>
                        </thead>
                        <tbody id="compare_tbody">
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="col-4 offset-4 d-none" id="winner">
                    <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_winner">
                        <tbody id="winner_tbody">
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="col-8 offset-2" id="tables">
                    <div id='points' class='d-none'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_points">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">All Time Earned</th>
                                    <th scope="col">All Time Spent</th>
                                    <th scope="col">Earned last 50 days</th>
                                    <th scope="col">Spent last 50 days</th>
                                    <th scope="col">Available Points</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($list_names as $i => $value) {
                                        echo "<tr><td id='name_$i'>".$value."</td>";
                                        echo "<td id='type_$i'>";
                                            switch($list_types[$i]) {
                                                case "1": echo "Main";
                                                break;
                                                case "2": echo "Alt";
                                                break;
                                                default: echo "Bot";
                                            }
                                        echo "</td>";
                                        echo "<td>".$list_total_earned[$i]."</td>";
                                        echo "<td>".$list_total_spent[$i]."</td>";
                                        echo "<td>".$list_last50_earned[$i]."</td>";
                                        echo "<td>".$list_last50_spent[$i]."</td>";
                                        echo "<td id='points_$i'>".($list_last50_earned[$i]-$list_last50_spent[$i])."</td>";
                                        echo "<td><button class='btn btn-sm btn-primary' id='compare_".$i."'>Compare</button></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
                    <div id='timers' class='d-none'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_timers">
                            <thead>
                                <tr>
                                    <th scope="col">Boss</th>
                                    <th scope="col">Last Killed</th>
                                    <th scope="col">Start Window</th>
                                    <th scope="col">End Window</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $timezone  = +1;
                                    foreach ($timers as $i => $value) {
                                        echo "<tr><td class='align-middle'>".$value['name_boss']."</td>";
                                        echo "<td class='align-middle'>".$value['last_killed']."</td>";
                                        echo "<td class='align-middle'>".$value['start_window']."</td>";
                                        echo "<td class='align-middle'>".$value['end_window']."</td>";
                                        echo "<td class='align-middle'>";
                                        if (gmdate("Y-m-d H:i:s",time()+ 3600*($timezone+date("I"))) > $value['end_window']) {
                                            echo "<div class='btn btn-sm btn-block btn-success'>UP</div></td><td class='align-middle'><a href='officers/event/".$value['id_boss']."' class='btn btn-sm btn-block btn-primary'>Create Event</a>";
                                        }
                                        else {
                                            if (gmdate("Y-m-d H:i:s",time()+ 3600*($timezone+date("I"))) < $value['start_window']) {
                                                echo "<div class='btn btn-sm btn-block btn-danger'>DOWN</div></td><td>";
                                            }
                                            else {
                                                echo "<div class='btn btn-sm btn-block btn-warning'>IN WINDOW</div></td><td class='align-middle'><a href='officers/event/".$value['id_boss']."' class='btn btn-sm btn-block  btn-primary'>Create Event</a>";
                                            }
                                        }
                                        echo "</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
                    <div id='attendance' class='d-none'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_attendance">
                            <thead>
                                <tr>
                                    <th scope="col">Event</th>
                                    <th scope="col">Characters</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($events as $i => $value) {
                                        echo "<td class='align-middle'>".$value."</td>";
                                        echo "<td class='align-middle'>";
                                        $found = false;
                                        for ($j = 0; $j < count($attendance_list); $j++) {
                                            $attendance_entry = $attendance_list[$j];
                                            if ($attendance_entry['id_event'] == $i) {
                                                echo $attendance_entry['name_character']." ";
                                                $found = true;
                                            }
                                        }
                                        echo "</td>";
                                        if ($found == true) {
                                            echo "<td class='align-middle'><a href='".site_url()."/officers/show_modify_attendance/".$i."' class='btn btn-warning btn-sm'>Modify</a></td></tr>";
                                        }
                                        else {
                                            echo "<td class='align-middle'><a href='".site_url()."/officers/show_insert_attendance/".$i."' class='btn btn-success btn-sm'>New</a></td></tr>";
                                        }  
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
                </div>
            </div>
            <?php 
                if(isset($this->session->table)) {
                    echo "<script>show('".$this->session->table."')</script>";
                }
                else {
                    echo "<script>show('points')</script>";
                }
            ?>
