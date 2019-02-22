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
        $("#compare_tbody").append("<tr id='row_" + id + "'><td class='align-middle'>" + $("#name_" + id).html() + "</td><td class='align-middle'>" + $("#type_" + id).html() + "</td><td class='align-middle'>" + $("#points_" + id).html()
            + "</td><td class='align-middle'><button id='remove_" + id +"' class='btn btn-warning btn-sm font-weight-bold'>&times;</button></td></tr>");
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

    $('#table_points,#table_loot,#table_roster').on("click", ".character", function() {
        var id_character = ($(this).attr('class').slice(24));;
        $.ajax({
            url: 'ajax/show_character/',
            data: { 'id_character': id_character },
            type: 'post',
            success: function (output) {
                var data = JSON.parse(output);
                switch (data['type_character']) {
                    case "1": var type = "Main";break;
                    case "2": var type = "Alt";break;
                    default: var type = "Bot";
                }
                let timestamp_last_event;
                let boss_last_event;
                let timestamp_last_loot;
                let item_last_loot;
                if (data['timestamp_last_event'] == undefined) {
                    if (data['timestamp_last_botted'] == undefined) {
                        timestamp_last_event = "n/a";
                        boss_last_event = "";
                    }
                    else {
                        timestamp_last_event = data['timestamp_last_botted'];
                        boss_last_event = "(" + data['boss_last_event'] + ")";
                    }
                }
                else {
                    timestamp_last_event = data['timestamp_last_event'];
                    boss_last_event = "(" + data['boss_last_event'] + ")";
                }
                if (data['timestamp_last_loot'] == undefined) {
                    timestamp_last_loot = "n/a";
                    item_last_loot = "";
                }
                else {
                    timestamp_last_loot = data['timestamp_last_loot'];
                    item_last_loot = "(" + data['item_last_loot'] + ")";
                }
                
                $("#title_character").text(data['name_character']+" "+data['level_character']+" "+data['class_character']);
                $("#content_character").html("Type: " + type + "<br/>Player: " + data['name_player']+"<br/><br/>Earned all time: " + data['total_earned'] + "<br/>Spent all time: " + data['total_spent'] + "<br/></br>Earned last 50 days: " + data['last50_earned'] + "<br/>Spent last 50 days: " + data['last50_spent'] +"<br/><br/>Current Points: " +(data['last50_earned']-data['last50_spent']) +"<br/><br/>Last Event: " +timestamp_last_event +" " +boss_last_event +"<br/>Last Loot: " +timestamp_last_loot +" "+item_last_loot);
                $("#modal_character").modal();
            },
            error: function () {
                $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div><br/>");
            }
        });
    });

    $('#table_bosses,#table_items,#table_events').on("click", ".boss", function () {
        var id_boss = ($(this).attr('class').slice(14));;
        $.ajax({
            url: 'ajax/list_kills/',
            data: { 'id_boss': id_boss },
            type: 'post',
            success: function (output) {
                var data = JSON.parse(output);
                if (data['last_killed'] == null) {
                    data['last_killed'] = "n/a";
                }
                if (data['first_killed'] == null) {
                    data['first_killed'] = "n/a";
                }
                $("#title_boss").text(data['name_boss']);
                $("#content_boss").html("Tracked kills: "+data['total_kills']+"<br/>First killed: " + data['first_killed']+"<br/>Last killed: " + data['last_killed'] + "<br/>");
                $.ajax({
                    url: 'ajax/list_items/',
                    data: { 'id_boss': id_boss },
                    type: 'post',
                    success: function (output) {
                        var data2 = JSON.parse(output);
                        if (data2.length != 0) {
                            $("#content_boss").append("<br/>List of drops:<br/>");
                            for (i in data2) {
                                let percentage = 0;
                                let drops = " drops ";
                                if (data['total_kills'] != 0) {
                                    percentage = parseInt(100*data2[i]['number_drops'] / data['total_kills']);
                                }
                                if (data2[i]['number_drops'] == 1) {
                                    drops = " drop ";
                                }
                                $("#content_boss").append("<br/>" + data2[i]['name_item'] + " (" + data2[i]['number_drops'] + drops +"- " +percentage +" %)");
                            }
                        }                      
                        $("#modal_boss").modal();
                    },
                    error: function () {
                        $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div><br/>");
                    }
                });
            },
            error: function () {
                $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div><br/>");
            }
        });
    });

    $('#table_loot,#table_items').on("click", ".item", function () {
        var id_item = ($(this).attr('class').slice(14));;
        $.ajax({
            url: 'ajax/show_item/',
            data: { 'id_item': id_item },
            type: 'post',
            success: function (output) {
                var data = JSON.parse(output);
                $("#title_item").text(decodeHtml(data['name_item']));
                $("#content_item").html("Number of drops: " + data['number_drops'] +"<br/>");
                if (data['name_first_looter'] != undefined) {
                    $("#content_item").append("<br/>First looted by: "+data['name_first_looter']+" ("+data['timestamp_first_loot']+")");
                }
                if (data['name_last_looter'] != undefined) {
                    $("#content_item").append("<br/>Last looted by: " + data['name_last_looter'] + " (" + data['timestamp_last_loot'] + ")");
                }
                $("#content_item").append("<br/><br/><a href='http://allaclone.p2002.com/item.php?id="+id_item+"' target='_blank' class='btn btn-primary btn-sm'>Allaclone</a>")
                $("#modal_item").modal();
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
        url: 'ajax/get_max/',
        data: { 'comparing': comparing },
        type: 'post',
        success: function (output) {
            $("#winner_tbody").html("<tr><th>Maximum:</th><td>" + output + "</td></tr>");
        }
    });
}

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}
