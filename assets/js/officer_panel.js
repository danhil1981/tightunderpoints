$(document).ready(function () {
    $("[id^='datatable']").DataTable({"order": [[0, "asc"]]});

    var max_points = Number.MIN_SAFE_INTEGER;
    var max_id = "";
    var max_type = "Bot";
    var multiples = [];
    var winner_id = "";
    var comparing = [];

    $('#points').on('click', "button", function () {
        $("#compare").css("display", "block");
        $("#winner").css("display", "block");
        var id = (this.id.slice(8));
        var name = $("#name_" + id).html();
        var points = $("#points_" + id).html();
        var type = $("#type_" + id).html();
        comparing.push(id,name,points,type);
        for (var i = 0; i < (comparing/4).length(); i+4) {

        }
        /*$("#compare_tbody").append("<tr id='row_" + comparing + "'><td>" + $("#name_" + id).html() + "</td><td>" + $("#type_" + id).html() + "</td><td>" + $("#points_" + id).html()
            + "</td><td><button class='btn btn-sm btn-info' id='remove_" + id + "'>Remove</button></td></tr>");

        if (parseInt($("#points_" + id).html()) > max_points) {
            multiples = [];
            max_points = parseInt($("#points_" + id).html()); 
            max_id = $("#name_" + id).html();
            $("#winner_tbody").html("<tr><td>"+max_id+"</td><td>"+max_points+"</td></tr>");
        }
        if (parseInt($("#points_" + id).html()) == max_points) {
            multiples.push(id);
            winner_id = multiples[Math.floor(Math.random() * multiples.length)];
            $("#winner_tbody").html("<tr><td>" + $("#name_"+winner_id).html() + "</td><td>" + max_points + "</td></tr>");
        } */
    });

    $('#compare').on('click', "button", function () {
        var id = (this.id.slice(7));
        $('#row_'+id).remove();
        if (parseInt($("#points_" + id).html()) < max_points) {
            $("#winner_tbody").html("<tr><td>" + $("#name_" + id).html() + "</td><td>" + $("#points_" + id).html() + "</td></tr>");
        }
        else {
            multiples.slice(id,1);
            winner_id = multiples[Math.floor(Math.random() * multiples.length)];
            $("#winner_tbody").html("<tr><td>" + $("#name_" + winner_id).html() + "</td><td>" + max_points + "</td></tr>");
        }
        winner_id = multiples[Math.floor(Math.random() * multiples.length)];
        $("#winner_tbody").html("<tr><td>" + $("#name_" + winner_id).html() + "</td><td>" + max_points + "</td></tr>");
        if ($('#compare tr').length <= 1) {
            $('#compare').css("display", "none");
            $("#winner_tbody").html("");
            $('#winner').css("display", "none");
        }
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
