            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">Modify Event</h1>
                    <?php echo form_open('events/modify');?>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Boss
                        </div>
                        <?php echo form_dropdown('id_boss', $options, $event['id_boss'], "required class='form-control'");?>
                    </div>
                    <?php $options = [0 => '-- Not part of a raid --'] + $raid_descriptions;?>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Raid
                        </div>
                        <?php echo form_dropdown('id_raid', $options, $event['id_raid'], "required class='form-control'");?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Time
                        </div>
                        <?php echo form_time('time', substr($event['timestamp'], 11, 5), "required class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Date
                        </div>
                        <?php echo form_date('date', substr($event['timestamp'], 0, 10), "required class='form-control'")?>
                    </div>
                    <div class="form-group">
                        <div class="text-white mt-5 mb-2">
                            Parse URL (optional)
                        </div>
                        <?php echo form_input('url_parse', $event['url_parse'], "maxlength='512' class='form-control'")?>
                    </div>
                    <div class="text-center mt-5">
                        <?php
                            echo form_hidden('id', $event['id']);
                            echo form_submit('submit', 'Modify', "class='btn btn-success btn-sm'");
                            echo anchor('admins', 'Cancel', "class='btn btn-danger btn-sm'");
                            echo form_close();
                        ?>
                    </div>
                </div>
            </div>
