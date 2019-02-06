$(document).ready(function() {
    $(".checks:checkbox:checked").each(function() {
        id = this.id.slice(7);
        $("#dropdown_"+id).removeClass("d-none").addClass("d-block");
    });
    

});
