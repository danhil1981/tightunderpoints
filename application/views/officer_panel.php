            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/officer_panel.js"></script>
            
            <h1 class='text-center text-white'>Officer Panel</h1>

            <div class="row" id="menu_buttons">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($msg)) echo $msg ?>
                    <br/><br/>
                    <button id='button_points' class="btn btn-primary btn-sm">Points</button>
                    <button id='button_timers' class="btn btn-light btn-sm">Timers</button>
                    <br/><br/>
                </div>
            </div>

            <div class="row">
                <div class="col-4 offset-4">
                    <div id='compare' style='display: none'>
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
                        <br/>
                    </div>
                </div>

                <div class="col-4 offset-4">
                        <div id="winner" style="display: none">
                            <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_winner">
                                <tbody id="winner_tbody">
                                </tbody>
                            </table>
                        </div>
                        <br/>
                    </div>
                </div>
    
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
                                        echo "<td id='type_$i'>".$list_types[$i]."</td>";
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
                </div>
            </div>
            <?php
                if (isset($table_to_show)) {
                    echo "<script>show('".$table_to_show."');</script>";
                }
            ?>
