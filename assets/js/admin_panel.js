$(document).ready(function () {
    $("#tables table").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [50, 100, 500]
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
