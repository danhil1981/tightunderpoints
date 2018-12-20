            <h1 class='text-center text-white'>Officer Panel</h1>

            <div class="row">
                <div class="col-10 offset-1 text-center">
                    <?php if(isset($msg)) echo $msg ?>
                    <br/><br/>
                    <button onclick='show("point_list")' id='button_point_list' class="btn btn-primary btn-sm">Points</button>
                    <button onclick='show("respawn_timers")' id='button_respawn_timers' class="btn btn-light btn-sm">Timers</button>
                </div>
            </div>
