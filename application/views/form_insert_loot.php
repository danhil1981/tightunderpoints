            <script src="<?php echo base_url()?>assets/js/loot.js"></script>
            <div class="row my-5" id="content">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Loot Entry</h1>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open('/loot/officer_insert');?>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Character
                        </div>
                        <div class="form-inline-block">
                            <?php echo form_dropdown('id_character', $character_names, $id_character, "disabled class='form-control float-left'");?>
                        </div>
                    </div>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Raid
                        </div>
                        <div class="form-inline d-block">
                            <?php $options = [0 => '-- Not part of a raid --'] + $raid_descriptions;echo form_dropdown('id_raid', $options, '', "id='raid_dropdown' class='form-control float-left'");?>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_raid">New Raid</button>
                        </div>
                    </div>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Event
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_event', $events_not_in_raid, '', "id='event_dropdown' class='form-control float-left'");?>
                            <button type="button" class="btn btn-primary float-right" id="new_event" data-toggle="modal" data-target="#modal_event">New Event</button>
                        </div>
                    </div>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Item
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_item', '', '', "id='item_dropdown' class='form-control float-left'");?>
                            <button type="button" class='btn btn-primary float-right' id="new_item" data-toggle="modal" data-target="#modal_item">New Item</button>
                        </div>
                    </div>
                    <?php echo form_hidden('id_character', $id_character);?>
                    <div class="text-center pt-5">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-success btn-sm'");?>
                        <?php echo anchor('officers', 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
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
                                <input type="text" id="raid_description" class="form-control my-3" required="true"/>
                                Date:
                                <?php echo form_date('date', gmdate('Y-m-d'), "id='raid_date' required class='form-control my-3'")?>
                                <div class="text-center">
                                    <button id="insert_raid" class="btn btn-success">Create</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
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
                                <select class="form-control my-3" disabled="true" id="selected_raid"></select>
                                Boss:
                                <?php
                                    $options = $boss_names;
                                    echo form_dropdown('id_boss', $options, '', "required id='event_boss_id' class='form-control my-3'");
                                ?>
                                Time:
                                <?php $timezone = +1; echo form_time('time', gmdate('H:i', time() + 3600 * ($timezone + date('I'))), "required id='event_time' class='form-control my-3'")?>
                                Date:
                                <?php echo form_date('date', gmdate('Y-m-d'), "required id='event_date' class='form-control my-3'")?>
                                <div class="text-center">
                                    <button id="insert_event" class="btn btn-success">Create</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
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
                                <input type="number" class="form-control my-3" id="id_item" min="1" max="32768" required/>
                                Name
                                <input type="text" class="form-control my-3" id="name_item" required/>
                                Drops From
                                <?php $options = $boss_names; echo form_dropdown('id_boss', $options, '', "required id='boss_dropdown' class='form-control my-3'");?>
                                Points
                                <?php $options = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15'];?>
                                <?php echo form_dropdown('value_item', $options, '', "required id='value_item' class='form-control my-3'");?>
                                <div class="text-center">
                                    <button id="insert_item" class="btn btn-success">Create</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
