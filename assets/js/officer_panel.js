$(document).ready(function () {
    comparing = [{}];
    multiples = [];
    $("#table_points").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, "asc"],
        "columnDefs": [{
            "targets": [8],
            "orderable": false
        }]
    });

    $("#table_timers").DataTable({
        "bAutoWidth": false,
        "lengthMenu": [50, 100, 500],
        "order": [3, "asc"],
        "columnDefs": [
            {
                "targets": [7, 8],
                "orderable": false
            },
            {
                "orderData": [4],
                "targets": [1]
            },
            {
                "targets": [4],
                "visible": false,
                "searchable": false
            },
            {
                "orderData": [5],
                "targets": [2]
            },
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            },
            {
                "orderData": [6],
                "targets": [3]
            },
            {
                "targets": [6],
                "visible": false,
                "searchable": false
            }
        ],
        "language": {
            "emptyTable": "No tracked events within the last 2 weeks"
        }
    });

    $("#table_attendance").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, "desc"],
        "columnDefs": [{
            "targets": [2],
            "orderable": false
        }]
    });

    $("#table_players").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, "asc"],
        "columnDefs": [{
            "targets": [1, 2],
            "orderable": false
        }]
    });

    $("#table_characters").DataTable({
        "lengthMenu": [50, 100, 500],
        "order": [0, "asc"],
        "columnDefs": [{
            "targets": [5, 6],
            "orderable": false
        }]
    });

    $("#points").on("click", "button", function () {
        $("#compare").addClass("d-block");
        $("#winner").addClass("d-block");
        var id = parseInt(this.id.slice(8));
        var name = $(".character_"+id).html();
        $(this).addClass("d-none");
        var points = parseInt($("#points_" + id).html());
        var type = $("#type_" + id).html();
        switch (type) {
            case "Main":
                type = 1;
                break;
            case "Alt":
                type = 2;
                break;
            default:
                type = 3;
        }
        object = {
            "id": id,
            "name": name,
            "points": points,
            "type": type
        };
        comparing.push(object);
        $("#compare_tbody").append("<tr id='row_" + id + "'><td class='align-middle'>" + $("#name_" + id).html() + "</td><td class='align-middle'>" + $("#type_" + id).html() + "</td><td class='align-middle'>" + $("#points_" + id).html() +"</td><td><div class='btn-group'><a title='Loot' href='loot/show_officer_insert/" + id + "' class='btn btn-sm btn-success mr-0'><i class='material-icons align-middle'>shopping_cart</i></a><button id='remove_" + id + "' class='btn btn-danger btn-sm font-weight-bold'><i class='material-icons align-middle'>cancel</i></button></div></td></tr>");
        get_list();


    });

    $("#compare").on("click", "button", function () {
        var id = parseInt(this.id.slice(7));
        $("#row_" + id).remove();
        $("#compare_" + id).removeClass("d-none");
        for (let i = 1; i < comparing.length; i++) {
            if (comparing[i].id == id) {
                comparing.splice(i, 1);
            }
        }
        if (comparing.length > 1) {
            get_list();
        } else {
            $("#compare").removeClass("d-block").addClass("d-none");
            $("#winner").removeClass("d-block").addClass("d-none");
        }
    });

    $("#menu_buttons").on("click", "button", function () {
        $("#menu_buttons button").removeClass("btn-primary").addClass("btn-light");
        $(this).removeClass("btn-light").addClass("btn-primary");
        $("#tables").children().removeClass("d-block").addClass("d-none");
        $("#" + this.id.slice(7)).removeClass("d-none").addClass("d-block");
        $("#winner").removeClass("d-block").addClass("d-none");
        $("#compare").removeClass("d-block").addClass("d-none");
        comparing = [];
        $("#compare_tbody").html("");
        $("#points button").removeClass("d-none");
    });

    $('#table_points,#table_characters').on("click", ".character", function () {
        var id_character = ($(this).attr('class').slice(24));
        $.ajax({
            url: "ajax/get_character_info/",
            data: {
                "id_character": id_character
            },
            type: "post",
            success: function (output) {
                var data = JSON.parse(output);
                switch (data["type_character"]) {
                    case "1":
                        var type = "Main";
                        break;
                    case "2":
                        var type = "Alt";
                        break;
                    default:
                        var type = "Bot";
                }
                let timestamp_last_event;
                let boss_last_event;
                let timestamp_last_loot;
                let item_last_loot;
                if (data["timestamp_last_event"] == undefined) {
                    if (data["timestamp_last_botted"] == undefined) {
                        timestamp_last_event = "n/a";
                        boss_last_event = "";
                    } else {
                        timestamp_last_event = data["timestamp_last_botted"];
                        boss_last_event = "(" + data["boss_last_event"] + ")";
                    }
                } else {
                    timestamp_last_event = data["timestamp_last_event"];
                    boss_last_event = "(" + data["boss_last_event"] + ")";
                }
                if (data["timestamp_last_loot"] == undefined) {
                    timestamp_last_loot = "n/a";
                    item_last_loot = "";
                } else {
                    timestamp_last_loot = data["timestamp_last_loot"];
                    item_last_loot = "(" + data["item_last_loot"] + ")";
                }

                $("#title_character").text(data["name_character"] + " " + data["level_character"] + " " + data["class_character"]);
                $("#content_character").html("Type: " + type + "<br/>Player: " + data["name_player"] + "<br/><br/>Earned all time: " + data["total_earned"] + "<br/>Spent all time: " + data["total_spent"] + "<br/>Earned last 50 days: " + data["last50_earned"] + "<br/>Spent last 50 days: " + data["last50_spent"] + "<br/>Current Points: " + (data["last50_earned"] - data["last50_spent"]) + "<br/><br/>Last Event: " + timestamp_last_event + " " + boss_last_event + "<br/>Last Loot: " + timestamp_last_loot + " " + item_last_loot);
                $("#modal_character").modal();
            },
            error: function () {
                $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
    });

    $('#table_timers').on("click", ".boss", function () {
        var id_boss = ($(this).attr("class").slice(14));;
        $.ajax({
            url: "ajax/get_list_kills/",
            data: {
                "id_boss": id_boss
            },
            type: "post",
            success: function (output) {
                var data = JSON.parse(output);
                if (data["last_killed"] == null) {
                    data["last_killed"] = "n/a";
                }
                if (data["first_killed"] == null) {
                    data["first_killed"] = "n/a";
                }
                $("#title_boss").text(data["name_boss"]);
                $("#content_boss").html("Tracked kills: " + data["total_kills"] + "<br/><br/>First killed: " + data["first_killed"] + "<br/>Last killed: " + data["last_killed"] + "");
                $.ajax({
                    url: "ajax/get_list_items/",
                    data: {
                        "id_boss": id_boss
                    },
                    type: "post",
                    success: function (output) {
                        var data2 = JSON.parse(output);
                        if (data2.length != 0) {
                            $("#content_boss").append("<br/><br/>List of drops:<br/>");
                            for (i in data2) {
                                let percentage = 0;
                                let drops = " drops ";
                                if (data["total_kills"] != 0) {
                                    percentage = parseInt(100 * data2[i]["number_drops"] / data["total_kills"]);
                                }
                                if (data2[i]["number_drops"] == 1) {
                                    drops = " drop ";
                                }
                                $("#content_boss").append("<br/>" + data2[i]["name_item"] + " (" + data2[i]["number_drops"] + drops + "- " + percentage + " %)");
                            }
                        }
                        $("#modal_boss").modal();
                    },
                    error: function () {
                        $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div>");
                    }
                });
            },
            error: function () {
                $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div>");
            }
        });
    });

    $('#modal_delete_confirmation').on('show.bs.modal', function (e) {
        $(this).find('#form_delete_confirmation').attr('action', $(e.relatedTarget).data('href'));
        $(this).find('.modal-title').html($(e.relatedTarget).data('env') + ' Deletion Confirmation');
        $(this).find('.modal-body').html(
            'Are you sure you want to delete the ' +
            $(e.relatedTarget).data('env') +
            '<div><strong>' + $(e.relatedTarget).data('title') + '</strong>?</div>'
        );
    });

});

function show(table) {
    $("#button_" + table).removeClass("btn-light").addClass("btn-primary");
    $("#" + table).removeClass("d-none").addClass("d-block");
}

function get_winner() {
    $.ajax({
        url: "ajax/get_winner/",
        data: {
            "comparing": comparing
        },
        type: "post",
        success: function (output) {
            $("#winner_tbody").html("<tr><th class='align-middle'>Winner:</th><td class='align-middle'>" + output.substring(parseInt(output).toString().length) + "</td><td><a title='Loot' href='loot/show_officer_insert/" + parseInt(output) + "' class='btn btn-sm btn-success mr-0'><i class='material-icons align-middle'>shopping_cart</i></a></td></tr>");
        },
        error: function () {
            $("#messages").html("<br><br><div class='badge badge-danger'>Ajax request failed</div>");
        }
    });
}

function clipboard() {
    var el = document.getElementById("random_list");
    var range = document.createRange();
    range.selectNodeContents(el);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
    document.execCommand('copy');
    alert("Contents copied to clipboard.");
    return false;
}

function get_list() {
    let max_points = -32000;
    let min_type = 3;
    let character_names = [];
    let list = "";
    for (let i = 1; i < comparing.length; i++) {
        if (comparing[i].points > max_points) {
            max_points = comparing[i].points;
        }
        if (comparing[i].type < min_type) {
            min_type = comparing[i].type;
        }
    }
    for (let i = 1; i < comparing.length; i++) {
        if (comparing[i].points >= max_points - 6 && comparing[i].type == min_type) {
            character_names.push(comparing[i].name);
        }
    }

    for (let i = 0; i < character_names.length; i++) {
        list += "[" +(i+1) + " - " +character_names[i] +"], ";
    }
    list = list.slice(0, -2);
    $("#winner_tbody").html("<tr><td id='random_list' class='align-middle'>List of eligible characters: "+list+"</td><td><a onclick='clipboard()' title='Copy to Clipboard' class='btn btn-sm btn-success mr-0'><i class='material-icons align-middle'>file_copy</i></a></td></tr>");
}