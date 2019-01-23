var comparing = [];

$(document).ready(function () {
    $("[id^='datatable']").DataTable();

    $('#points').on('click', "button", function () {
        $("#compare").css("display", "block");
        $("#winner").css("display", "block");
        var id = this.id.slice(8);
        var points = parseInt($("#points_" + id).html());
        var type = parseInt($("#type_" + id).html());

        comparing.push(id,points,type);
        $("#compare_tbody").append("<tr id='row_" + id + "'><td>" + $("#name_" + id).html() + "</td><td>" + $("#type_" + id).html() + "</td><td>" + $("#points_" + id).html()
            + "</td><td><button class='btn btn-sm btn-info' id='remove_" + id + "'>Remove</button></td></tr>");
        get_winner();
    });

    $('#compare').on('click', "button", function () {
        var id = (this.id.slice(7));
        $('#row_'+id).remove();
        var index = comparing.indexOf(id);
        comparing.splice(index,3);
        get_winner();
    });

    $('#menu_buttons').on('click', "button", function () {
        $('#menu_buttons button').removeClass('btn-primary');
        $('#menu_buttons button').addClass('btn-light');
        $(this).removeClass('btn-light');
        $(this).addClass('btn-primary');
        $('#tables').children().css("display", "none");
        $('#'+this.id.slice(7)).css("display", "block");
    });

});

function get_winner() {
    var max_id = "";
    var max_points = Number.MIN_SAFE_INTEGER;
    var max_type = 3;
    var multiples = [];
    for (var i = 0; i < comparing.length; i=i+3) {
        if (comparing[i + 2] < max_type) {
            max_id = comparing[i];
            max_points = comparing[i + 1];
            max_type = comparing[i + 2];
        }
        else {
            if (comparing[i + 2] == max_type) {
                if (comparing[i + 1] > max_points) {
                    var multiples = []
                    max_id = comparing[i];
                    max_points = comparing[i + 1];
                }
                 
                if (comparing[i + 1] == max_points) {
                    multiples.push(max_id);
                    multiples.push(comparing[i]);
                    max_id = multiples[Math.floor(Math.random() * multiples.length)];
                }
            }
        }
    }
    $("#winner_tbody").html("<tr><td>" + $("#name_" + max_id).html() + "</td><td>" + $("#points_" + max_id).html() + "</td><td><a href='officers/loot/"+max_id+"' class='btn btn-sm btn-success'>Loot</a></td></tr>");
}
