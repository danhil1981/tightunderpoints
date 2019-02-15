$(document).ready(function () {
    path = window.location.href.substring(0, window.location.href.lastIndexOf('events'));
    $("#insert_raid").attr("disabled", "true");

    $("#insert_raid").click(function () {
        var description = $("#raid_description").val();
        var date = $("#raid_date").val();
        $.ajax({
            url: path + 'officers/insert_raid/',
            data: { 'description': description, 'date': date },
            type: 'post',
            success: function (output) {
                if (parseInt(output) < 1) {
                    $("#messages").html("<br><br><div class='badge badge-success'>Database Error</div><br/>");
                }
                else {
                    $("#messages").html("<br><br><div class='badge badge-success'>Raid successfully created</div><br/>");
                    var id_raid = output;
                    var description_raid = date + " - " + description;
                    $("#raid_dropdown").append(new Option(description_raid, id_raid));
                    $('#raid_dropdown option:last').attr("selected", "selected");
                }
            },
            error: function () {
                $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div><br/>");
            }
        });
        $('#modal_raid').modal('hide');
        $('#form_raid')[0].reset();
        return false;
    });

    $('#modal_raid').on('shown.bs.modal', function () {
        $('#raid_description').focus();
    })

    $("#raid_description").keyup(function () {
        if ($("#raid_description").val() != "") {
            $("#insert_raid").removeAttr("disabled");
        }
        else {
            $("#insert_raid").attr("disabled", "true");
        }
    });

});
