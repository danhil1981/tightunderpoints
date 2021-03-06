$(document).ready(function () {
    path = window.location.href.substring(0, window.location.href.lastIndexOf("loot"));
    $("input[type=submit]").attr("disabled", "true");
    $("#insert_raid").attr("disabled", "true");
    $("#insert_item").attr("disabled", "true");

    $("#insert_raid").click(function () {
        var description = $("#raid_description").val();
        var date = $("#raid_date").val();
        $.ajax({
            url: path + "ajax/officer_insert_raid/",
            data: {
                "description": description,
                "date": date
            },
            type: "post",
            success: function (output) {
                if (parseInt(output) < 1) {
                    $("#messages").html("<div class='badge badge-success'>Database Error</div>");
                } else {
                    $("#messages").html("<div class='badge badge-success'>Raid successfully created</div>");
                    var id_raid = output;
                    var description_raid = date + " - " + description;
                    $("#raid_dropdown").append(new Option(description_raid, id_raid));
                    $('#raid_dropdown option:last').attr("selected", "selected");
                }
            },
            error: function () {
                $("#messages").html("<div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
        $("#modal_raid").modal("hide");
        $("#form_raid")[0].reset();
        $("#event_dropdown option").remove();
        $("#item_dropdown option").remove();
        return false;
    });

    $("#raid_dropdown").change(function () {
        var id_raid = $("#raid_dropdown").val();
        $.ajax({
            url: path + "ajax/get_events/",
            data: {
                "id_raid": id_raid
            },
            type: "post",
            success: function (output) {
                $("#event_dropdown option").remove();
                $("#item_dropdown option").remove();
                $.each(JSON.parse(output), function (id_event, name_event) {
                    $("#event_dropdown").append($("<option></option>").attr("value", id_event).text(name_event));
                    $("#event_dropdown").trigger("change");
                })
            },
            error: function () {
                $("#messages").html("<div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
        return false;
    });

    $("#new_event").click(function () {
        var id_raid = $("#raid_dropdown").val();
        var description_raid = $("#raid_dropdown :selected").text();
        $("#selected_raid option").remove();
        $("#selected_raid").append($("<option></option>").attr("value", id_raid).text(description_raid));
    });

    $("#insert_event").click(function () {
        var time = $("#event_time").val();
        var date = $("#event_date").val();
        var id_boss = $("#event_boss_id").val();
        var id_raid = $("#raid_dropdown").val();
        $.ajax({
            url: path + "ajax/officer_insert_event/",
            data: {
                "time": time,
                "date": date,
                "id_boss": id_boss,
                "id_raid": id_raid
            },
            type: "post",
            success: function (output) {
                if (parseInt(output) == 0) {
                    $("#messages").html("<div class='badge badge-success'>Database Error</div>");
                } else {
                    var data = JSON.parse(output);
                    var id_event = data["id_event"];
                    var timestamp = data["timestamp"];
                    var name_boss = data["name_boss"];
                    $("#messages").html("<div class='badge badge-success'>Event successfully created</div>");
                    $("#event_dropdown").append(new Option(timestamp + " - " + name_boss, id_event));
                    $("#event_dropdown option:last").attr("selected", "selected");
                }
            },
            error: function () {
                $("#messages").html("<div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
        $("#modal_event").modal("hide");
        $("#form_event")[0].reset();
        $("#raid_dropdown").trigger("change");
        return false;
    });

    $("#event_dropdown").change(function () {
        var id_event = $("#event_dropdown").val();
        $.ajax({
            url: path + "ajax/get_drops/",
            data: {
                "id_event": id_event
            },
            type: "post",
            success: function (output) {
                $("#item_dropdown option").remove();
                $.each(JSON.parse(output), function (id_item, name_item) {
                    $("#item_dropdown").append($("<option></option>").attr("value", id_item).text(decodeHtml(name_item)));
                })
                $("#item_dropdown").trigger("change");
            },
            error: function () {
                $("#messages").html("<div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
        return false;
    });

    $("#new_item").click(function () {
        var id_event = $("#event_dropdown").val();
        if (id_event != null) {
            $("#boss_dropdown").prop("disabled", true);
            $.ajax({
                url: path + "ajax/get_boss/",
                data: {
                    "id_event": id_event
                },
                type: "post",
                success: function (output) {
                    $("#boss_dropdown").val(output);
                },
                error: function () {
                    $("#messages").html("<div class='badge badge-danger'>Ajax request failed</div>");
                }
            });
        }
    });

    $("#insert_item").click(function () {
        var id_item = $("#id_item").val();
        var name_item = $("#name_item").val();
        var id_boss = $("#boss_dropdown").val();
        var value_item = $("#value_item").val();
        $.ajax({
            url: path + "ajax/officer_insert_item/",
            data: {
                "id_item": id_item,
                "name_item": name_item,
                "id_boss": id_boss,
                "value_item": value_item
            },
            type: "post",
            success: function (output) {
                if (parseInt(output) == 0) {
                    $("#messages").html("<div class='badge badge-success'>Database Error</div>");
                } else {
                    $("#messages").html("<div class='badge badge-success'>Item successfully created</div>");
                }
            },
            error: function () {
                $("#messages").html("<div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
        $("#modal_item").modal("hide");
        $("#form_item")[0].reset();
        $("#raid_dropdown").trigger("change");
        return false;
    });

    if ($("#event_dropdown").has("option")) {
        $("#raid_dropdown").trigger("change");
    }

    $("#modal_raid").on("shown.bs.modal", function () {
        $("#raid_description").focus();
    })

    $("#modal_event").on("shown.bs.modal", function () {
        $("#event_boss_id").focus();
    })

    $("#modal_item").on("shown.bs.modal", function () {
        $("#id_item").focus();
    })

    $("#item_dropdown").change(function () {
        if ($(this).val() != null) {
            $("input[type=submit]").removeAttr("disabled");
        } else {
            $("input[type=submit]").attr("disabled", "true");
        }
    });

    $("#raid_description").keyup(function () {
        if ($("#raid_description").val() != "") {
            $("#insert_raid").removeAttr("disabled");
        } else {
            $("#insert_raid").attr("disabled", "true");
        }
    });

    $("#id_item").keyup(function () {
        if ($("#name_item").val() != "" && $("#id_item").val() != "") {
            $("#insert_item").removeAttr("disabled");
        } else {
            $("#insert_item").attr("disabled", "true");
        }
    });

    $("#name_item").keyup(function () {
        if ($("#name_item").val() != "" && $("#id_item").val() != "") {
            $("#insert_item").removeAttr("disabled");
        } else {
            $("#insert_item").attr("disabled", "true");
        }
    });

});

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}