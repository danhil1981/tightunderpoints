            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Player</h1>

                    <br/><br/>
        
                    <?php echo form_open_multipart('players/modify');?>

                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input('name',$player['name'],'required class="form-control"')?>
                        <br/><br/>
                    </div>
                    <?php echo form_hidden('id',$player['id']);?>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');?>
                    <?php echo anchor('users/admin_panel', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>
            