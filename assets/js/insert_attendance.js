$(document).ready(function () {
    character_list = [];
    $("#submit").attr("disabled", "true");

    $("#add_character").click(function () {
        var name = $("#character_dropdown option:selected").text();
        var id = $("#character_dropdown").val();
        $("#characters").removeClass("d-none").addClass("d-block");
        $("#tcell_characters").append("<div class='btn btn-sm btn-secondary m-1' id='" + id + "'>" + name + "<button class='close text-white' id='" + id + name + "'><div class='small ml-1'>&times;</div></button></div>");
        $("#character_dropdown option[value='" + id + "']").remove();
        character_list.push(id);
        $("#list_characters").attr("value", character_list);
        $("#submit").removeAttr("disabled");
        return false;
    });

    $("#tcell_characters").on("click", "button", function () {
        var id = parseInt(this.id);
        var name = this.id.substring(parseInt(this.id).toString().length);
        $("#" + id).remove();
        $("#character_dropdown").append($("<option></option>").val(id).html(name));
        $("#character_dropdown").html($("#character_dropdown option").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        }))
        $("#character_dropdown").prop("selectedIndex", 0);
        var index = character_list.indexOf(id.toString());
        character_list.splice(index, 1)
        $("#list_characters").attr("value", character_list);
        if ($("#tcell_characters").html().length == 0) {
            $("#characters").removeClass("d-block").addClass("d-none");
            $("#submit").attr("disabled", "true");
        }
        return false;
    });

    $("#upload_input").change(function () {
        $("#upload-file-info").html(this.files[0].name).removeClass("float-right").addClass("float-left");
        $(".manual_input").addClass("d-none");
        $("#label_characters").html("Logfile<br/><br/>");
        $("#characters").removeClass("d-block").addClass("d-none");
        $("#submit").removeAttr("disabled");
    });

});