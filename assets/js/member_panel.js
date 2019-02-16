$(document).ready(function () {
    comparing = [];
    $("#tables table").DataTable();

    $('#points').on('click', "button", function () {
        $("#compare").addClass('d-block');
        $("#winner").addClass('d-block');
        var id = parseInt(this.id.slice(8));
        $(this).addClass("d-none");
        var points = parseInt($("#points_" + id).html());
        var type = $("#type_" + id).html();
        switch (type) {
            case "Main": type = 1;
                break;
            case "Alt": type = 2;
                break;
            default: type = 3;
        }
        comparing.push(id, points, type);
        $("#compare_tbody").append("<tr id='row_" + id + "'><td>" + $("#name_" + id).html() + "</td><td>" + $("#type_" + id).html() + "</td><td>" + $("#points_" + id).html()
            + "</td></tr>");
        $.ajax({
            url: 'members/get_max/',
            data: { 'comparing': comparing },
            type: 'post',
            success: function (output) {
                $("#winner_tbody").html("<tr><th>Maximum:</th><td>" +output + "</td></tr>");
            }
        });
    });

    $('#menu_buttons').on('click', "button", function () {
        $('#menu_buttons button').removeClass('btn-primary').addClass('btn-light');
        $(this).removeClass('btn-light').addClass('btn-primary');
        $('#tables').children().removeClass('d-block').addClass('d-none');
        $('#' + this.id.slice(7)).removeClass('d-none').addClass('d-block');
        $('#winner').removeClass('d-block').addClass('d-none');
        $('#compare').removeClass('d-block').addClass('d-none');
        comparing = [];
        $("#compare_tbody").html("");
        $('#points button').removeClass("d-none");
    });

});

function show(table) {
    $('#button_' + table).removeClass('btn-light').addClass('btn-primary');
    $('#' + table).removeClass('d-none').addClass('d-block');
}
