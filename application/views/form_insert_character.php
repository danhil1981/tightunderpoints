            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Character</h1>
                    <br/><br/>
                    <?php echo form_open("characters/insert");?>
                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input("name", "", "required pattern='^[A-Za-z]+$' maxlength='32' title='1 word consisting of uppercase/lowercase letters' class='form-control'")?>
                        <br/>
                    </div>
                    <?php $options = array_combine(range(1, 65), range(1, 65));?>
                    <div class="form-group">
                        <div class="text-white">
                            Level<br/><br/>
                        </div>
                        <?php echo form_dropdown("level", $options, "", "required class='form-control'");?>
                        <br/>
                    </div>
                    <?php $options = array("BRD" => "BRD","BST" => "BST","CLR" => "CLR", "DRU" => "DRU", "ENC" => "ENC", "MAG" => "MAG", "MNK" => "MNK", "NEC" => "NEC", "PAL" => "PAL", "RNG" => "RNG", "ROG" => "ROG", "SHD" => "SHD", "SHM" => "SHM", "WAR" => "WAR", "WIZ" => "WIZ");?>
                    <div class="form-group">
                        <div class="text-white">
                            Class<br/><br/>
                        </div>
                        <?php echo form_dropdown("class", $options, "", "required class='form-control'");?>
                        <br/>
                    </div>
                    <?php $options = array("1" => "Main","2" => "Alt","3" => "Bot");?>
                    <div class="form-group">
                        <div class="text-white">
                            Type<br/><br/>
                        </div>
                        <?php echo form_dropdown("type", $options, "", "required class='form-control'");?>
                        <br/>
                    </div>
                    <?php $options = $player_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Player<br/><br/>
                        </div>
                        <?php echo form_dropdown("id_player", $options, "", "required class='form-control'");?>
                        <br/><br/>
                    </div>
                    <?php echo form_hidden("source", $source);?>
                    <?php echo form_submit("submit", "Create", "class='btn btn-success btn-sm'");?>
                    <?php echo anchor($source, "Cancel", "class='btn btn-danger btn-sm'");?>
                    <?php echo form_close();?>
                </div>
            </div>
