tables = ['users','players'/*,'characters','raids','events','bosses','items','drops','attendence','loots'*/];

function show(table) {
    for (i=0; i<tables.length;i++) {
        document.getElementById("button_"+tables[i]).className = "btn";
        document.getElementById(tables[i]).style.display = "none";
    }
    document.getElementById("button_"+table).className = "btn btn-primary";
    document.getElementById(table).style.display = "block";
}
