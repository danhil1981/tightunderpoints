$(document).ready(function () {

    $('#menu_buttons').on('click', "button", function () {
        $('#menu_buttons button').removeClass('btn-primary');
        $('#menu_buttons button').addClass('btn-light');
        $(this).removeClass('btn-light');
        $(this).addClass('btn-primary');
        $('#tables').children().css("display", "none");
        $('#'+this.id.slice(7)).css("display", "block");
    });

});
