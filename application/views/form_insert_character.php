            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Character</h1>
                    <div class="text-center mt-5 mb-2">
                        <?php
                            if (isset($msg)) {
                                echo $msg;
                            }
                        ?>
                    </div>
                    <?php echo form_open('characters/insert');?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Name
                        </div>
                        <?php echo form_input('name', '', "required pattern='^[A-Za-z]+$' maxlength='32' title='1 word consisting of uppercase/lowercase letters' class='form-control'")?>
                    </div>
                    <?php $options = array_combine(range(1, 65), range(1, 65));?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Level
                        </div>
                        <?php echo form_dropdown('level', $options, '', "required class='form-control'");?>
                    </div>
                    <?php $options = ['BRD' => 'BRD', 'BST' => 'BST', 'CLR' => 'CLR', 'DRU' => 'DRU', 'ENC' => 'ENC', 'MAG' => 'MAG', 'MNK' => 'MNK', 'NEC' => 'NEC', 'PAL' => 'PAL', 'RNG' => 'RNG', 'ROG' => 'ROG', 'SHD' => 'SHD', 'SHM' => 'SHM', 'WAR' => 'WAR', 'WIZ' => 'WIZ'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Class
                        </div>
                        <?php echo form_dropdown('class', $options, '', "required class='form-control'");?>
                    </div>
                    <?php $options = ['1' => 'Main', '2' => 'Alt', '3' => 'Bot'];?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Type
                        </div>
                        <?php echo form_dropdown('type', $options, '', "required class='form-control'");?>
                    </div>
                    <?php $options = $player_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Player
                        </div>
                        <?php echo form_dropdown('id_player', $options, '', "required class='form-control'");?>
                        
                    </div>
                    <?php echo form_hidden('source', $source);?>
                    <div class="text-center mt-5">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-primary btn-sm'");?>
                        <?php echo anchor($source, 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>