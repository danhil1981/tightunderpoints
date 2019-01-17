$(document).ready(function () {
    $("[id^='datatable']").DataTable({"order": [[1, "asc"]]});

    $('#points').on('click', "button", function () {
        $("#compare").css("display", "block");
        var id = (this.id.slice(8));
        $("#compare_tbody").append("<tr id='row_" + id + "'><td>" + $("#name_" + id).html() + "</td><td>" + $("#points_" + id).html()
            + "</td><td><button class='btn btn-sm btn-warning' id='remove_" + id + "'>Remove</button></td></tr>");
    });

    $('#compare').on('click', "button", function () {
        var id = (this.id.slice(7));
        $('#row_'+id).remove();
        if ($('#compare tr').length <= 1) {
            $('#compare').css("display", "none");
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
