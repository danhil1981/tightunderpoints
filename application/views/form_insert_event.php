            <script src="<?php echo base_url()?>assets/js/event.js"></script>
            <div class="row my-5">
                <div class="col-6 offset-3">
                    <h1 class="text-center text-white">New Event</h1>
                    <div id="messages" class="text-center"></div>
                    <?php echo form_open('events/insert');?>
                    <?php $options = $boss_names;?>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Boss
                        </div>
                        <div class="form-inline-block">
                        <?php
                            if (!isset($id_boss)) {
                                $id_boss = '';
                            }
                            echo form_dropdown('id_boss', $options, $id_boss, "required class='form-control'");
                        ?>
                        </div>
                    </div>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Raid
                        </div>
                        <div class="form-inline d-block">
                            <?php $options = $options = [0 => '-- Not part of a raid --'] + $raid_descriptions;?>
                            <?php echo form_dropdown('id_raid', $options, '', "required id='raid_dropdown' class='form-control float-left'");?>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#modal_raid">New Raid</button>
                        </div>
                    </div>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Time
                        </div>
                        <?php $timezone = +1; echo form_time('time', gmdate('H:i', time() + 3600 * ($timezone + date('I'))), "required class='form-control'")?>
                    </div>
                    <div class="form-group my-5">
                        <div class="text-white pb-2">
                            Date
                        </div>
                        <?php echo form_date('date', gmdate('Y-m-d'), "required class='form-control'")?>
                    </div>
                    <?php echo form_hidden('source', $source);?>
                    <div class="text-center">
                        <?php echo form_submit('submit', 'Create', "class='btn btn-success btn-sm'");?>
                        <?php echo anchor($source, 'Cancel', "class='btn btn-danger btn-sm'");?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <div class="modal fade" id="modal_raid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                                <input type="text" id="raid_description" class="form-control my-3" required="true" />
                                Date:
                                <?php echo form_date('date', gmdate('Y-m-d'), "id='raid_date' required class='form-control my-3'")?>
                                <div class="text-center mt-5">
                                    <button id="insert_raid" class="btn btn-primary">Create</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>