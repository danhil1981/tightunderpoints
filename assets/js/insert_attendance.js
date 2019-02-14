$(document).ready(function () {
    character_list = [];

    $('#add_character').click(function() {
        var name = $('#character_dropdown option:selected').text();
        var id = $('#character_dropdown').val();
        $('#characters').removeClass('d-none').addClass('d-block');
        $('#tbody_characters').append('<tr id="'+id+'"><td>'+id+'</td><td>'+name+'</td><td><button id="'+id+name+'" class="btn btn-sm btn-primary">Remove</button></td></tr>');
        $('#character_dropdown option[value="'+id+'"]').remove();
        character_list.push(id);
        $('#list_characters').attr('value', character_list);
        return false;
    });

    $('#tbody_characters').on('click', "button", function () {
        var id = parseInt(this.id);
        var name = this.id.substring(parseInt(this.id).toString().length);
        $('#'+id).remove();
        $('#character_dropdown').append($('<option></option>').val(id).html(name));
        $("#character_dropdown").html($("#character_dropdown option").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        }))
        $("#character_dropdown").prop("selectedIndex", 0);
        var index = character_list.indexOf(id.toString());
        character_list.splice(index, 1)
        $('#list_characters').attr('value', character_list);
        if ($('tbody > tr').length == 0) {
            $('#characters').removeClass('d-block').addClass('d-none');
        }
        return false;
    });

    $('#upload_input').change(function(){
        $('#upload-file-info').html(this.files[0].name).removeClass('float-right').addClass('float-left');
        $('.manual_input').addClass('d-none');
        $('#label_characters').html('Logfile<br/><br/>');
        $('#characters').removeClass('d-block').addClass('d-none');
    });

});
