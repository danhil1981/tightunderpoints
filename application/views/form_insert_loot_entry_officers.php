            <script>
                $(document).ready( function () {
                    $("#insert_raid").click( function() {
                        var description = $("#raid_description").val();
                        var date = $("#raid_date").val();
            
                        $.ajax({ 
                            url: '<?php echo site_url()?>/officers/insert_raid/',
                            data: { 'description':description, 'date':date },
                            type: 'post',
                            success: function(output) {
                                if (parseInt(output) < 1) {
                                    $("#messages").html("<br><br><div class='badge badge-success'>Error on insertion</div><br/>");
                                }
                                else {
                                    $("#messages").html("<br><br><div class='badge badge-success'>Raid successfully inserted</div><br/>");
                                    var id_raid = output;
                                    var description_raid = date +" - " +description;
                                    $("#raid_dropdown").append(new Option(description_raid, id_raid));
                                    $('#raid_dropdown option:last').attr("selected", "selected");
                                }
                            }
                        });
                        $("#modal_raid").removeClass("show");
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                        $('#form_raid')[0].reset();
                        return false;
                    });
                    
                    $("#raid_dropdown").change(function() {
                        var id_raid = $("#raid_dropdown").prop('selectedIndex');
                        $.ajax({
                            url: '<?php echo site_url()?>/officers/get_events/',
                            data: {'id_raid':id_raid},
                            type: 'post', 
                            success: function(output) {
                                $.each(output, function(test1, test2) {
                                    $("#event_dropdown").append($('<option></option>').attr('value', test1).text(test2));
                                });   
                            }
                        });
                        return false;
                    });
                });
            </script>
            
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
                                <input type="submit" value="Submit" id="insert_raid" class="btn btn-primary"/>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Raid</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-center text-white">New Event</h1>
            
                            <form id="form_raid">
                                FORM HERE
                                <input type="submit" value="Submit" id="insert_event" class="btn btn-primary"/>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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

                    <div class="form-group" id="event_dropdown">
                        <div class="text-white">
                            Event<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                            <?php echo form_dropdown('id_event', $events_not_raid , '', 'class="form-control float-left"');?>
                            <button class='btn btn-primary float-right' data-toggle="modal" data-target="#modal_event";">New</button>
                        </div>
                        <br/><br/>
                    </div>

                    <div class="form-group d-none" id="drop_dropdown">
                        <div class="text-white">
                            Drop<br/><br/>
                        </div>
                        <div class="form-inline d-block">
                        <?php echo form_dropdown('id_drop', '' , '', 'class="form-control float-left"');?>
                        <button class='btn btn-primary float-right' onclick="new_drop();">New</button>
                        </div>
                        <br/><br/>
                    </div>

                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-success btn-small"');?>
                    <?php echo anchor('officers', 'Cancel', 'class="btn btn-danger btn-small"');?>
                    <?php echo form_close();?>
                </div>
            </div>
