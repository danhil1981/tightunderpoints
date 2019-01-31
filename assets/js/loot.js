$(document).ready( function () {
    path = window.location.href.substring(0,window.location.href.lastIndexOf('loot'));

    $("#insert_raid").click( function() {
        var description = $("#raid_description").val();
        var date = $("#raid_date").val();

        $.ajax({ 
            url: path +'insert_raid/',
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
        $("#event_dropdown option").remove();
        $("#item_dropdown option").remove();
        return false;
    });
    
    $("#raid_dropdown").change(function() {
        var id_raid = $("#raid_dropdown").prop('selectedIndex');
        $.ajax({
            url: path +'get_events/',
            data: {'id_raid':id_raid},
            type: 'post', 
            success: function(output) {
                $("#event_dropdown option").remove();
                $("#item_dropdown option").remove();
                $.each(JSON.parse(output), function (id_event, name_event) {
                    $("#event_dropdown").append($('<option></option>').attr('value', id_event).text(name_event));
                    $("#event_dropdown").trigger("change");
                })   
            }
        });
        return false;
    });

    $("#new_event").click(function() {
        var id_raid = $("#raid_dropdown").val();
        var description_raid = $("#raid_dropdown :selected").text();
        $("#selected_raid option").remove();
        $("#selected_raid").append($("<option></option>").attr("value", id_raid).text(description_raid));
    });

    $("#insert_event").click( function() {
        var time = $("#event_time").val();
        var date = $("#event_date").val();
        var id_boss = $("#event_boss_id").val();
        var id_raid = $("#raid_dropdown").val();
        $.ajax({ 
            url: path +'insert_event/',
            data: { 'time':time, 'date':date, 'id_boss':id_boss , 'id_raid':id_raid  },
            type: 'post',
            success: function(output) {
                if (parseInt(output) == 0) {
                    $("#messages").html("<br><br><div class='badge badge-success'>Error on insertion</div><br/>");
                }
                else {
                    var id_event = output.substring(0,output.indexOf(","));
                    var description_event = output.substring(output.indexOf(",")+1);
                    $("#messages").html("<br><br><div class='badge badge-success'>Event successfully inserted</div><br/>");
                    $("#event_dropdown").append(new Option(description_event, id_event));
                    $('#event_dropdown option:last').attr("selected", "selected");
                }
            }
        });
        $("#modal_event").removeClass("show");
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
        $('#form_event')[0].reset();
        $("#raid_dropdown").trigger("change");
        return false;
    });

    $("#event_dropdown").change(function() {
        var id_event = $("#event_dropdown").val();
        $.ajax({
            url: path +'get_drops/',
            data: {'id_event':id_event},
            type: 'post', 
            success: function(output) {
                $("#item_dropdown option").remove();
                $.each(JSON.parse(output), function (id_item, name_item) {
                    $("#item_dropdown").append($('<option></option>').attr('value', id_item).text(decodeHtml(name_item)));
                })   
            }
        });
        return false;
    });

    $("#new_item").click(function() {
        var id_event = $("#event_dropdown").val();
        $.ajax({ 
            url: path +'get_boss/',
            data: { 'id_event':id_event},
            type: 'post',
            success: function(output) {
                $('#boss_dropdown').val(output);
                }
        });
    });

    $("#insert_item").click( function() {
        var id_item = $("#id_item").val();
        var name_item = $("#name_item").val();
        var id_boss = $("#boss_dropdown").val();
        var value_item = $("#value_item").val();
        $.ajax({ 
            url: path +'insert_item/',
            data: { 'id_item':id_item, 'name_item':name_item, 'id_boss':id_boss , 'value_item':value_item  },
            type: 'post',
            success: function(output) {
                if (parseInt(output) == 0) {
                    $("#messages").html("<br><br><div class='badge badge-success'>Error on insertion</div><br/>");
                }
                else {
                    $("#messages").html("<br><br><div class='badge badge-success'>Item successfully inserted</div><br/>");
                }
            }
        });
        $("#modal_item").removeClass("show");
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
        $('#form_item')[0].reset();
        $("#raid_dropdown").trigger("change");
        return false;
    });
    $("#raid_dropdown").trigger("change");

});

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}