tables = ['users', 'players', 'characters', 'raids', 'bosses', 'items', 'events', 'drops', 'attendance','loot'];

$(document).ready(function () {
    $("#tables table").DataTable({"order": [[1, "asc"]]});
});

function show(table) {
    for (i=0; i<tables.length;i++) {
        document.getElementById("button_" + tables[i]).className = "btn btn-light btn-sm";
        document.getElementById(tables[i]).style.display = "none";
    }
    document.getElementById("button_"+table).className = "btn btn-primary btn-sm";
    document.getElementById(table).style.display = "block";
}
