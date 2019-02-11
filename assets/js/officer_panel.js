$(document).ready(function () {
    comparing = [];
    $("#tables table").DataTable();

    $('#points').on('click', "button", function () {
        $("#compare").addClass('d-block');
        $("#winner").addClass('d-block');
        var id = parseInt(this.id.slice(8));
        this.remove();
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
            + "</td></tr>");
        $.ajax({
            url: 'officers/get_winner/',
            data: { 'comparing': comparing},
            type: 'post',
            success: function(output) {
                $("#winner_tbody").html("<tr><th>Winner:</th><td>"+output.substring(parseInt(output).toString().length)+"</td><td><a href='/officers/loot/"+parseInt(output)+"' class='btn btn-block btn-sm btn-success'>Loot</a></td></tr>");
            }
        });
    });

    $('#menu_buttons').on('click', "button", function () {
        $('#menu_buttons button').removeClass('btn-primary').addClass('btn-light');
        $(this).removeClass('btn-light').addClass('btn-primary');
        $('#tables').children().removeClass('d-block').addClass('d-none');
        $('#'+this.id.slice(7)).removeClass('d-none').addClass('d-block');
    });

});

function show(table) {
    $('#button_'+table).removeClass('btn-light').addClass('btn-primary');
    $('#'+table).removeClass('d-none').addClass('d-block');
}
