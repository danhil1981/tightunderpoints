            <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/custom.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url()?>assets/js/scripts2.js"></script>
            
            <h1 class='text-center text-white'>Officer Panel</h1>

            <div class="row">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($msg)) echo $msg ?>
                    <br/><br/>
                    <button onclick='show("point")' id='button_point_list' class="btn btn-primary btn-sm">Points</button>
                    <button onclick='show("timers")' id='button_respawn_timers' class="btn btn-light btn-sm">Timers</button>
                    <br/><br/>
                </div>
            </div>

            <div class="row">
                <div class="col-8 offset-2">
                    <div id='points'>
                        <table class='table table-dark table-striped table-bordered table-hover table-sm text-center' id="table_points">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">All Time Earned</th>
                                    <th scope="col">All Time Spent</th>
                                    <th scope="col">Earned last 50 days</th>
                                    <th scope="col">Spent last 50 days</th>
                                    <th scope="col">Available Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($character_names as $i => $value) {
                                        echo "<tr><th scope='row'><input id='checkbox_".$value."' type='checkbox'/></th>";                                                                                                   
                                        echo "<td>".$value."</td>";
                                        echo "<td>".$list_total_earned[$i]."</td>";
                                        echo "<td>".$list_total_spent[$i]."</td>";
                                        echo "<td>".$list_last50_earned[$i]."</td>";
                                        echo "<td>".$list_last50_spent[$i]."</td>";
                                        echo "<td>".($list_last50_earned[$i]-$list_last50_spent[$i])."</td></tr>";
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
