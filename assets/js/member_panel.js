$(document).ready(function () {
    comparing = [];
    $("#table_events, #table_loot, #table_raids").DataTable( {
        "lengthMenu": [25, 50, 100, 500],
        "autoWidth": false,
        "order": [1, 'asc'],
        "columnDefs": [
            { 'orderData': [0], 'targets': [1] },
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $("#table_points").DataTable( {
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
        "columnDefs": [{ "targets": [7], "orderable": false }]
    });

    $("#table_roster").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
    });

    $("#table_items").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, 'asc'],
        "columnDefs": [{ "targets": [3], "orderable": false }]
    });

    $("#table_bosses").DataTable({
        "lengthMenu": [25, 50, 100, 500],
        "autoWidth": false,
        "order": [0, 'asc'],
        "columnDefs": [
            { 'orderData': [1], 'targets': [2] },
            {
                "targets": [1],
                "visible": false,
                "searchable": false
            },
            { 'orderData': [3], 'targets': [4] },
            {
                "targets": [3],
                "visible": false,
                "searchable": false
            }
        ]
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
        comparing.push(id, points, type);
        $("#compare_tbody").append("<tr id='row_" + id + "'><td>" + $("#name_" + id).html() + "</td><td>" + $("#type_" + id).html() + "</td><td>" + $("#points_" + id).html()
            + "</td><td><button id='remove_" + id +"' class='btn btn-warning btn-sm font-weight-bold'>&times;</button></td></tr>");
        get_max();
    });

    $("#compare").on("click", "button", function () {
        var id = parseInt(this.id.slice(7));
        $("#row_" + id).remove();
        $("#compare_" + id).removeClass("d-none");
        comparing.splice(comparing.indexOf(id), 3);
        if (comparing.length > 0) {
            get_max();
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
        $('#' + this.id.slice(7)).removeClass('d-none').addClass('d-block');
        $('#winner').removeClass('d-block').addClass('d-none');
        $('#compare').removeClass('d-block').addClass('d-none');
        comparing = [];
        $("#compare_tbody").html("");
        $('#points button').removeClass("d-none");
    });

    $('#table_points,#table_loot,#roster').on("click", ".character", function() {
        var id_character = ($(this).attr('class').slice(24));;
        $.ajax({
            url: 'members/show_character/',
            data: { 'id_character': id_character },
            type: 'post',
            success: function (output) {
                var data = JSON.parse(output);
                switch (data['type_character']) {
                    case "1": var type = "Main";break;
                    case "2": var type = "Alt";break;
                    default: var type = "Bot";
                }
                $("#title_character").text(data['name_character']+" "+data['level_character']+" "+data['class_character']);
                $("#content_character").html("Type: " + type + "<br/>Player: " + data['name_player']+"<br/><br/>Earned all time: " + data['total_earned'] + "<br/>Spent all time: " + data['total_spent'] + "<br/></br>Earned last 50 days: " + data['last50_earned'] + "<br/>Spent last 50 days: " + data['last50_spent'] +"<br/><br/>Current Points: " +(data['last50_earned']-data['last50_spent']) +"<br/><br/>Last Event: " +data['timestamp_last_event'] +" (" +data['boss_last_event'] +")<br/>Last Loot: " +data['timestamp_last_loot'] +" (" +data['item_last_loot'] +")");
                $("#modal_character").modal();
            },
            error: function () {
                $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div><br/>");
            }
        });
    });

});

function show(table) {
    $('#button_' + table).removeClass('btn-light').addClass('btn-primary');
    $('#' + table).removeClass('d-none').addClass('d-block');
}

function get_max() {
    $.ajax({
        url: 'members/get_max/',
        data: { 'comparing': comparing },
        type: 'post',
        success: function (output) {
            $("#winner_tbody").html("<tr><th>Maximum:</th><td>" + output + "</td></tr>");
        }
    });
}
