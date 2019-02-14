$(document).ready(function () {
    path = window.location.href.substring(0, window.location.href.lastIndexOf('drops'));

    $("#event_dropdown").change(function () {
        var id_event = $("#event_dropdown").val();
        $.ajax({
            url: path + '/officers/get_drops/',
            data: { 'id_event': id_event },
            type: 'post',
            success: function (output) {
                $("#item_dropdown option").remove();
                $.each(JSON.parse(output), function (id_item, name_item) {
                    $("#item_dropdown").append($('<option></option>').attr('value', id_item).text(decodeHtml(name_item)));
                })
            }
        });
        return false;
    });

    $("#event_dropdown").trigger("change");
    
    if (Number.isInteger(+window.location.href.substr(-1))) {
        $("#item_dropdown").val($("#id_item").val());
    }
    
});

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}
