            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Character</h1>

                    <br/><br/>
        
                    <?php echo form_open_multipart('characters/insert');?>

                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input('name','','required class="form-control"')?>
                        <br/>
                    </div>

                    <?php $options = range(1,65);?>
                    <div class="form-group">
                        <div class="text-white">
                            Level<br/><br/>
                        </div>
                        <?php echo form_dropdown('level', $options, '', 'required class="form-control"');?>
                        <br/>
                    </div>

                    <?php $options = array('BRD' => 'BRD','BST' => 'BST','CLR' => 'CLR', 'DRU' => 'DRU', 'ENC' => 'ENC', 'MAG' => 'MAG', 'MNK' => 'MNK', 'NEC' => 'NEC', 'PAL' => 'PAL', 'RNG' => 'RNG', 'ROG' => 'ROG', 'SHD' => 'SHD', 'SHM' => 'SHM', 'WAR' => 'WAR', 'WIZ' => 'WIZ');?>
                    <div class="form-group">
                        <div class="text-white">
                            Class<br/><br/>
                        </div>
                        <?php echo form_dropdown('class', $options, '', 'required class="form-control"');?>
                        <br/>
                    </div>

                    <?php $options = array('Main' => 'Main','Alt' => 'Alt','Bot' => 'Bot');?>
                    <div class="form-group">
                        <div class="text-white">
                            Type<br/><br/>
                        </div>
                        <?php echo form_dropdown('type', $options, '', 'required class="form-control"');?>
                        <br/>
                    </div>

                    <?php $options = $player_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Player<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_player', $options, '', 'required class="form-control"');?>
                        <br/><br/>
                    </div>

                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');?>
                    <?php echo anchor('users/admin_panel', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>
