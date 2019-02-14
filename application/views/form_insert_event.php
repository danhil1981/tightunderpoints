            <script src="<?php echo base_url()?>assets/js/event.js"></script>
            <div class="row">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Event</h1>
                    <br/><br/>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open_multipart('events/insert');?>
                    <?php $options = $boss_names;?>
                    <div class="form-group">
                        <div class="text-white">
                            Boss<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_boss', $options, '', 'required class="form-control"');?>
                        <br/><br/>
                    </div>
                    <?php $options = $raid_descriptions;array_unshift($options,"-- Not part of a raid --");?>
                    <div class="form-group">
                        <div class="text-white">
                            Raid<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_raid', $options, '', 'required id="raid_dropdown" class="form-control float-left"');?>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_raid">New Raid</button>
                        </div>
                        <br/><br/>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Time<br/><br/>
                        </div>
                        <?php $timezone  = +1; echo form_time('time',gmdate("H:i", time()+ 3600*($timezone+date("I"))), 'required class="form-control"')?>
                    </div>
                    <div class="form-group">
                        <div class="text-white">
                            Date<br/><br/>
                        </div>
                        <?php echo form_date('date',gmdate('Y-m-d'), 'required class="form-control"')?>
                    </div>
                    <?php echo form_hidden('source',$source);?>
                    <?php echo form_submit('submit', 'Create', 'class="btn btn-primary btn-sm"');?>
                    <?php echo anchor($source, 'Cancel', 'class="btn btn-danger btn-sm"');?>
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
                                <button id="insert_raid" class="btn btn-success">Create</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
