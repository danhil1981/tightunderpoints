            <script src="<?php echo base_url()?>assets/js/loot.js"></script>
            <div class="row" id="content">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Loot Entry</h1>
                    <div id="messages" class="text-center"></div>
                    <br/><br/>
        
                    <?php echo form_open_multipart('');?>

                    <div class="form-group">
                        <div class="text-white">
                            Character<br/><br/>
                        </div>
                        <?php echo form_dropdown('id_character', $name_character, $id_character,'disabled="true" class="form-control"');?>
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
                            Event<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_event', $events_not_in_raid , '', 'id="event_dropdown" class="form-control float-left"');?>
                            <button type="button" class='btn btn-primary float-right' id="new_event" data-toggle="modal" data-target="#modal_event">New</button>
                        </div>
                        <br/><br/>
                    </div>

                    <div class="form-group">
                        <div class="text-white">
                            Item<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                        <?php echo form_dropdown('id_item', '' , '', 'id="item_dropdown" class="form-control float-left"');?>
                        <button type="button" class='btn btn-primary float-right' id="new_drop" data-toggle="modal" data-target="#modal_drop">New</button>
                        </div>
                        <br/><br/>
                    </div>

                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-success btn-small"');?>
                    <?php echo anchor('officers', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>

            <div class="modal fade" id="modal_raid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Raid</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-center text-white">New Raid</h1>
            
                            <form id="form_raid">
                                Description:
                                <input type="text" id="raid_description" class="form-control"/>
                                <br/>Date:
                                <?php echo form_date('date',gmdate('Y-m-d'), 'id="raid_date" required class="form-control"')?>
                                <br/>
                                <button id="insert_raid" class="btn btn-primary">Submit</button>
                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-center text-white">New Event</h1>
            
                            <form id="form_event">
                                Raid:
                                <select class="form-control" disabled="true" id="selected_raid">
                                </select>
                                Boss:
                                <?php 
                                    $options = $boss_names;
                                    echo form_dropdown('id_boss', $options, '', 'required id="event_boss_id" class="form-control"');
                                ?>
                                Time:
                                <?php $timezone  = +1; echo form_time('time',gmdate("H:i", time()+ 3600*($timezone+date("I"))), 'required id="event_time" class="form-control"')?>

                                Date:
                                <?php echo form_date('date',gmdate('Y-m-d'), 'required id="event_date" class="form-control"')?>

                                <button id="insert_event" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_drop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-center text-white">New Drop</h1>
            
                            <form id="form_drop">
                                Id
                                <input type="number" class="form-control" id="item_id" min="1" max="32768" required/>
                                Name
                                <input type="text" class="form-control" id="item_name" required/>
                                Drops From
                                <?php $options = $boss_names; echo form_dropdown('id_boss', $options, '', 'required class="form-control"');?>
                                Points:
                                <input type="number" class="form-control" name="value" min="0" max="15" required/>
                                <br/>
                                <button id="insert_item" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
