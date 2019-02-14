$(document).ready( function () {
    path = window.location.href.substring(0,window.location.href.lastIndexOf('loot'));
    $("input[type=submit]").attr("disabled", "true");
    $("#insert_raid").attr("disabled", "true");
    $("#insert_item").attr("disabled", "true");

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
        $('#modal_raid').modal('hide');
        $('#form_raid')[0].reset();
        $("#event_dropdown option").remove();
        $("#item_dropdown option").remove();
        return false;
    });

    $("#raid_dropdown").change(function() {
        var id_raid = $("#raid_dropdown").val();
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
        $("#item_dropdown").trigger("change");
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
            url: path +'insert_event_ajax/',
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
        $('#modal_event').modal('hide');
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
        $('#modal_item').modal('hide');
        $('#form_item')[0].reset();
        $("#raid_dropdown").trigger("change");
        return false;
    });
    $("#raid_dropdown").trigger("change");

    $('#modal_raid').on('shown.bs.modal', function () {
        $('#raid_description').focus();
    })

    $('#modal_event').on('shown.bs.modal', function () {
        $('#event_boss_id').focus();
    })

    $('#modal_item').on('shown.bs.modal', function () {
        $('#id_item').focus();
    })

    $("#item_dropdown").change(function() {
            $("input[type=submit]").removeAttr("disabled");
    });

    $("#raid_description").keyup(function () {
        if ($("#raid_description").val() != "") {
            $("#insert_raid").removeAttr("disabled");
        }
        else {
            $("#insert_raid").attr("disabled", "true");
        }
    });

    $("#id_item").keyup(function () {
        if ($("#name_item").val() != "" && $("#id_item").val() != "") {
            $("#insert_item").removeAttr("disabled");
        }
        else {
            $("#insert_item").attr("disabled", "true");
        }
    }); 

    $("#name_item").keyup(function () {
        if ($("#name_item").val() != "" && $("#id_item").val() != "") {
            $("#insert_item").removeAttr("disabled");
        }
        else {
            $("#insert_item").attr("disabled", "true");
        }
    }); 

});

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}