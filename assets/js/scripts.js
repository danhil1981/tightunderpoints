tables = ['users','players','characters'/*,'raids','events','bosses','items','drops','attendence','loots'*/];


$(document).ready(function () {
    for (i = 0; i < tables.length; i++) {
        $('#table_'+tables[i]).DataTable();
    }
});

function show(table) {
    for (i=0; i<tables.length;i++) {
        document.getElementById("button_" + tables[i]).className = "btn btn-light btn-sm";
        document.getElementById(tables[i]).style.display = "none";
    }
    document.getElementById("button_"+table).className = "btn btn-primary btn-sm";
    document.getElementById(table).style.display = "block";
}
