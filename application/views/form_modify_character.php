            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Character</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('characters/modify');?>
                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input('name', $character['name'],'required pattern="^[A-Za-z]+$" class="form-control"')?>
                        <br/>
                    </div>
                    <?php $options = range(1,65);?>
                    <div class="form-group">
                        <div class="text-white">
                            Level<br/><br/>
                        </div>
                        <?php echo form_dropdown('level', $options, $character['level']-1, 'required class="form-control"');?>
                        <br/>
                    </div>
                    <?php $options = array('BRD' => 'BRD','BST' => 'BST','CLR' => 'CLR', 'DRU' => 'DRU', 'ENC' => 'ENC', 'MAG' => 'MAG', 'MNK' => 'MNK', 'NEC' => 'NEC', 'PAL' => 'PAL', 'RNG' => 'RNG', 'ROG' => 'ROG', 'SHD' => 'SHD', 'SHM' => 'SHM', 'WAR' => 'WAR', 'WIZ' => 'WIZ');?>
                    <div class="form-group">
                        <div class="text-white">
                            Class<br/><br/>
                        </div>
                        <?php echo form_dropdown('class', $options, $character['class'], 'required class="form-control"');?>
                        <br/>
                    </div>
                    <?php $options = array('1' => 'Main','2' => 'Alt','3' => 'Bot');?>
                    <div class="form-group">
                        <div class="text-white">
                            Type<br/><br/>
                        </div>
                        <?php echo form_dropdown('type', $options, $character['type'], 'required class="form-control"');?>
                        <br/>
                    </div>
                    <?php $options = $player_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Player<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_player', $options, $character['id_player'], 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-sm"');?>
                    <?php echo form_hidden('id',$character['id']);?>
                    <?php echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                </div>
            </div>
