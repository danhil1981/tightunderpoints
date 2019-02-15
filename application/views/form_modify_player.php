            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Player</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('players/modify');?>
                    <div class="form-group">
                        <div class="text-white">
                            Name<br/><br/>
                        </div>
                        <?php echo form_input('name',$player['name'],'required pattern="^[A-Za-z]+$" maxlength="32" title="1 word consisting of uppercase/lowercase letters" class="form-control"')?>
                        <br/><br/>
                    </div>
                    <?php echo form_hidden('source',$source);?>
                    <?php echo form_hidden('id',$player['id']);?>
                    <?php echo form_submit('submit', 'Modify', 'class="btn btn-success btn-sm"');?>
                    <?php echo anchor($source, 'Cancel', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                </div>
            </div>
