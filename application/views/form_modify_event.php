            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Event</h1>
                    <br/><br/>
                    <?php echo form_open_multipart('events/modify');?>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Boss<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_boss', $options, $event['id_boss'], 'required class="form-control"');?>
                    </div>
                    <?php $options = $raid_descriptions;array_unshift($options,"-- Not part of a raid --");?>
                    <div class="form-group">
                        <div class="text-white">
                            Raid<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_raid', $options, $event['id_raid'], 'required class="form-control"');?>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Time<br/><br/>
                        </div>
                        <?php echo form_time('time', substr($event['timestamp'],11,5), 'required class="form-control"')?>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Date<br/><br/>
                        </div>
                        <?php echo form_date('date', substr($event['timestamp'],0,10), 'required class="form-control"')?>
                    </div>                                
                    <?php 
                        echo form_hidden('id',$event['id']);
                        echo form_submit('submit', 'Modify', 'class="btn btn-primary btn-sm"');
                        echo anchor('admins', 'Cancel', 'class="btn btn-danger btn-sm"');
                        echo form_close();
                    ?>
                </div>
            </div>
