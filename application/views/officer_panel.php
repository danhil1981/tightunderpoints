            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/officer_panel.js"></script>
            
            <h1 class='text-center text-white'>Officer Panel</h1>

            <div class="row" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($this->session->msg)) echo $this->session->msg ?>
                    <br/><br/>
                    <button id='button_points' class="btn btn-primary btn-sm">Points</button>
                    <button id='button_timers' class="btn btn-light btn-sm">Timers</button>
                    <a href='<?php echo site_url()?>' class='btn btn-danger btn-sm'>Logout</a>
                    <br/><br/>
                </div>
            </div>

            <div class="row">
                <div class="col-4 offset-4" id='compare' style='display: none'>
                    <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_compare">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Available Points</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="compare_tbody">
                        </tbody>
                    </table>
                </div>

                <br/>

                <div class="col-4 offset-4" id="winner" style="display: none">
                    <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_winner">
                        <tbody id="winner_tbody">
                        </tbody>
                    </table>
                </div>

                <br/>
    
                <div class="col-8 offset-2" id="tables">
                    <div id='points'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="datatable_points">
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
                                        echo "<td><button class='btn btn-sm btn-info' id='compare_".$i."'>Compare</button></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>
                    
                    <div id='timers' style='display:none'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="datatable_timers">
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
                                        echo "<tr><td>".$value['name_boss']."</td>";
                                        echo "<td>".$value['last_killed']."</td>";
                                        echo "<td>".$value['start_window']."</td>";
                                        echo "<td>".$value['end_window']."</td>";
                                        echo "<td>";
                                        if (gmdate("Y-m-d H:i:s",time()+ 3600*($timezone+date("I"))) > $value['end_window']) {
                                            echo "<div class='bg-success'>UP</div></td><td><button class='btn btn-sm btn-info' id='kill_".$value['id_boss']."'>Add Event</button></td>";
                                        }
                                        else {
                                            if (gmdate("Y-m-d H:i:s",time()+ 3600*($timezone+date("I"))) < $value['start_window']) {
                                                echo "<div class='bg-danger'>DOWN</div></td><td>";
                                            }
                                            else {
                                                echo "<div class='bg-warning text-dark'>IN WINDOW</div></td><td><button class='btn btn-sm btn-info' id='kill_".$value['id_boss']."'>Add Event</button></td>";
                                            }
                                        }
                                        echo "</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br/><br/>
                    </div>

                </div>
            </div>
