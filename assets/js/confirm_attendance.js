$(document).ready(function() {
    
    $(".checks:checkbox:checked").each(function() {
        var id = this.id.slice(7);
        $("#dropdown_"+id).removeClass("d-none").addClass("d-block");
    });
    
    $(".checks:checkbox").change(function() {
        var id = this.id.slice(7);
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            $("#dropdown_" + id).removeClass("d-none").addClass("d-block");
        }
        else {
            $("#dropdown_" + id).removeClass("d-block").addClass("d-none");
            $("#dropdown_" + id).prop("selectedIndex", 0)
        }
    });

    $(".dropdowns").change(function() {
        var id_dropdown = this.id.slice(9);
        var id_main = $("#"+this.id+" option:selected").val();
        $("#"+this.id).removeClass("dropdowns");
        $('#' + this.id + " option[value!='"+id_main+"']").remove();
        $(".dropdowns").each(function() {
            $("#"+this.id+" option[value='"+id_main+"']").remove();
        });
    });

});
