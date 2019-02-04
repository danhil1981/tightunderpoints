$(document).ready(function () {
    path = window.location.href.substring(0, window.location.href.lastIndexOf('event'));

    $("#insert_raid").click(function () {
        var description = $("#raid_description").val();
        var date = $("#raid_date").val();
        $.ajax({
            url: path + 'insert_raid/',
            data: { 'description': description, 'date': date },
            type: 'post',
            success: function (output) {
                if (parseInt(output) < 1) {
                    $("#messages").html("<br><br><div class='badge badge-success'>Error on insertion</div><br/>");
                }
                else {
                    $("#messages").html("<br><br><div class='badge badge-success'>Raid successfully inserted</div><br/>");
                    var id_raid = output;
                    var description_raid = date + " - " + description;
                    $("#raid_dropdown").append(new Option(description_raid, id_raid));
                    $('#raid_dropdown option:last').attr("selected", "selected");
                }
            }
        });
        $('#modal_raid').modal('hide');
        $('#form_raid')[0].reset();
        return false;
    });
    
});
