            <script src="<?php echo base_url()?>assets/js/event.js"></script>
            <div class="row" id="content">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Event Entry</h1>
                    <div id="messages" class="text-center"></div>
                    <br/><br/>
                    <?php echo form_open_multipart('officers/insert_event');?>
                    <div class="form-group">
                        <div class="text-white">
                            Boss<br/><br/>
                        </div>
                        <?php $options = $boss_names;echo form_dropdown('id_boss_', $options, $id_boss, 'disabled required class="form-control"'); ?>
                        <br/>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Raid<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                            <?php $options = $raid_descriptions;array_unshift($options,"-- Not part of a raid --");echo form_dropdown('id_raid', $options , '', 'id="raid_dropdown" class="form-control float-left"');?>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_raid">New</button>
                        </div>
                        <br/><br/>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Time<br/><br/>
                        </div>
                        <?php $timezone  = +1; echo form_time('time',gmdate("H:i", time()+ 3600*($timezone+date("I"))), 'required class="form-control"')?>
                        <br/>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Date<br/><br/>
                        </div>
                        <?php echo form_date('date',gmdate('Y-m-d'), 'required class="form-control"')?>
                        <br/><br/>
                    </div>
                    <?php echo form_hidden('id_boss',$id_boss);?>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-success btn-sm"');?>
                    <?php echo anchor('officers', 'Cancel', 'class="btn btn-danger btn-sm"');?>
                    <?php echo form_close();?>
                </div>
            </div>

            <div class="modal fade" id="modal_raid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Raid</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_raid">
                                Description:
                                <input type="text" id="raid_description" class="form-control" required="true"/>
                                <br/>
                                Date:
                                <?php echo form_date('date',gmdate('Y-m-d'), 'id="raid_date" required class="form-control"')?>
                                <br/>
                                <button id="insert_raid" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
