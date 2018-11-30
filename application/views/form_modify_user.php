<div class="container-fluid">
                <div class="row">
                    <div class="col-6 offset-3">
                        <h1 class="text-center text-white">Modify User</h1>

                        <br/><br/>
            
                        <?php echo form_open_multipart('users/modify');?>

                        <div class="form-group">
                            <div class="text-white">
                                Name<br/><br/>
                            </div>
                            <?php echo form_input('name',$user['name'],'required class="form-control"')?>
                            <br/><br/>
                        </div>
                        <?php echo form_hidden('id',$user['id']);?>
                        <?php echo form_submit('submit', 'Submit', 'class="btn btn-primary btn-small"');?>
                        <?php echo anchor('users/admin_panel', 'Cancel', 'class="btn btn-danger btn-small"');?>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
    