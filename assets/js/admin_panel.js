$(document).ready(function () {
    $("#table_users, #table_raids, #table_drops, #table_loot").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [10, 50, 100, 500],
        "columnDefs": [{ "targets": [3, 4], "orderable": false }]
    });

    $("#table_players").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [10, 50, 100, 500],
        "columnDefs": [{ "targets": [2, 3], "orderable": false }]
    });

    $("#table_characters").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [10, 50, 100, 500],
        "columnDefs": [{ "targets": [6, 7], "orderable": false }]
    });

    $("#table_bosses").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [10, 50, 100, 500],
        "columnDefs": [{ "targets": [5, 6], "orderable": false }]
    });

    $("#table_items").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [10, 50, 100, 500],
        "columnDefs": [{ "targets": [4, 5, 6], "orderable": false }]
    });

    $("#table_events, #table_attendance").DataTable({
        "order": [[0, "asc"]],
        "lengthMenu": [10, 50, 100, 500],
        "columnDefs": [{ "targets": [4, 5], "orderable": false }]
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
