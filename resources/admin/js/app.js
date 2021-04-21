require('./bootstrap');

$( document ).ready(function() {

    let regex = /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i;
    
    $('.form').on('submit', function(e){
        e.preventDefault();

        if ($(this).hasClass('disabled')) return; 

        var input = $(this).find('input[name="url"]');

        $('.alert-box .alert').removeClass().addClass('alert hidden');

        // Validate submitted URL
        var validate = regex.test(input.val());

        if (!validate) {
            $('.alert-box .alert').addClass('alert-danger').removeClass('hidden').html('Sorry but your URI is not valid');
            return;
        }

        $.post('/api/v1/create', { url:input.val(), method:'web' }, function( data ) {
            if (data.result) {
                $('input[name="url"]').val(data.result);
                $('.form').addClass('disabled');
                $('.btn-submit').removeClass('btn-submit').addClass('btn-copy').find('span').text('Copy');
                $('.alert-box .alert').addClass('alert-success').removeClass('hidden').html('Your link is ready!');
            } else if (data.error == "ALREADY_SHORTEN") {
                $('.alert-box .alert').addClass('alert-danger').removeClass('hidden').html(data.message);
            }
        });
        
    });

    $('body').on('click', '.btn-copy', function() {
        var copied = copyToClipboard($('input[name="url"]'));
        if (copied) {
            $('.alert-box .alert').addClass('alert-success').removeClass('hidden').html('Copied to clipboard');
        }
    });

});

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
    return true;
}