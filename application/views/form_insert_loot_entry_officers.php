            <script src="<?php echo base_url()?>assets/js/loot.js"></script>
            <div class="row" id="content">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Loot Entry</h1>
                    <div id="messages" class="text-center"></div>
                    <br/><br/>
                    <?php echo form_open_multipart('officers/insert_drop_loot');?>
                    <div class="form-group">
                        <div class="text-white">
                            Character<br/><br/>
                        </div>
                        <div class="form-inline-block">
                            <?php echo form_dropdown('id_character', $character_names, $id_character,'disabled class="form-control float-left"');?>
                        </div>
                        <br/><br/>
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
                        <button type="button" class='btn btn-primary float-right' id="new_item" data-toggle="modal" data-target="#modal_item">New</button>
                        </div>
                        <br/><br/><br/>
                    </div>
                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-success btn-small"');?>
                    <?php echo anchor('officers', 'Cancel', 'class="btn btn-danger btn-small"');?>
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
            <div class="modal fade" id="modal_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_event">
                                Raid:
                                <select class="form-control" disabled="true" id="selected_raid"></select>
                                <br/>
                                Boss:
                                <?php
                                    $options = $boss_names;
                                    echo form_dropdown('id_boss', $options, '', 'required id="event_boss_id" class="form-control"');
                                ?>
                                <br/>
                                Time:
                                <?php $timezone  = +1; echo form_time('time',gmdate("H:i", time()+ 3600*($timezone+date("I"))), 'required id="event_time" class="form-control"')?>
                                <br/>
                                Date:
                                <?php echo form_date('date',gmdate('Y-m-d'), 'required id="event_date" class="form-control"')?>
                                <br/>
                                <button id="insert_event" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_item">
                                Id
                                <input type="number" class="form-control" id="id_item" min="1" max="32768" required/>
                                <br/>
                                Name
                                <input type="text" class="form-control" id="name_item" required/>
                                <br/>
                                Drops From
                                <?php $options = $boss_names; echo form_dropdown('id_boss', $options, '', 'required disabled id="boss_dropdown" class="form-control"');?>
                                <br/>
                                Points
                                <input type="number" class="form-control" id="value_item" min="0" max="15" required/>
                                <br/>
                                <button id="insert_item" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
