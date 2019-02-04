$(document).ready(function () {

    $('#add_character').click( function () {
        alert($('#character_dropdown').val().text());
        return false;
    });

});
