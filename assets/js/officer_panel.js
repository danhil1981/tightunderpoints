$(document).ready(function () {
    comparing = [];
    $("#table_points").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
        "columnDefs": [{ "targets": [7], "orderable": false }]
    });

    $("#table_timers").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [3, 'asc'],
        "columnDefs": [{"targets": [4,5],"orderable": false}]
    });

    $("#table_attendance").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
        "columnDefs": [{ "targets": [2], "orderable": false }]
    });

    $("#table_players").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
        "columnDefs": [{ "targets": [1,2], "orderable": false }]
    });

    $("#table_characters").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
        "columnDefs": [{ "targets": [5,6], "orderable": false }]
    });

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
        comparing.push(id,points,type);
        $("#compare_tbody").append("<tr id='row_" + id + "'><td>" + $("#name_" + id).html() + "</td><td>" + $("#type_" + id).html() + "</td><td>" + $("#points_" + id).html()
            + "</td><td><button id='remove_" + id +"' class='btn btn-warning btn-sm font-weight-bold'>&times;</button></td></tr>");
        get_winner();
    });

    $("#compare").on("click", "button", function () {
        var id = parseInt(this.id.slice(7));
        $("#row_"+id).remove();
        $("#compare_" + id).removeClass("d-none");
        comparing.splice(comparing.indexOf(id), 3);
        if (comparing.length > 0) {
            get_winner();
        }
        else {
            $("#compare").removeClass('d-block').addClass('d-none');
            $("#winner").removeClass('d-block').addClass('d-none');
        }
    });

    $('#menu_buttons').on('click', "button", function () {
        $('#menu_buttons button').removeClass('btn-primary').addClass('btn-light');
        $(this).removeClass('btn-light').addClass('btn-primary');
        $('#tables').children().removeClass('d-block').addClass('d-none');
        $('#'+this.id.slice(7)).removeClass('d-none').addClass('d-block');
        $('#winner').removeClass('d-block').addClass('d-none');
        $('#compare').removeClass('d-block').addClass('d-none');
        comparing = [];
        $("#compare_tbody").html("");
        $('#points button').removeClass("d-none");
    });

});

function show(table) {
    $('#button_'+table).removeClass('btn-light').addClass('btn-primary');
    $('#'+table).removeClass('d-none').addClass('d-block');
}

function get_winner() {
    $.ajax({
        url: 'officers/get_winner/',
        data: { 'comparing': comparing },
        type: 'post',
        success: function (output) {
            $("#winner_tbody").html("<tr><th>Winner:</th><td>" + output.substring(parseInt(output).toString().length) + "</td><td><a href='officers/loot/" + parseInt(output) + "' class='btn btn-block btn-sm btn-success'>Loot</a></td></tr>");
        },
        error: function () {
            $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div><br/>");
        }
    });
}