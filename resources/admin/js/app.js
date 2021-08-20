require('./bootstrap');

$(function() {
    $('.disable').on('click', function(){
        if (confirm('Disable : ' + $(this).data('id') + ' ?')) {
            $.ajax({
                url: '',
                type: 'DELETE',
                success: function(result) {
                    console.log(result)
                }
            });
        } else {
            return;
        }
        
    });
});