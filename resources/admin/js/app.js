require('./bootstrap');

$(function() {

    console.log(window.location.pathname)

    // Action when clicking disable button
    $('.disable').on('click', function(){
        if (confirm('Disable : ' + $(this).data('id') + ' ?')) {
            const id = $(this).data('id')
            const href = window.location.pathname + '/' + id
            $.ajax({
                url: href,
                type: 'POST',
                data: { "_token": $('meta[name="csrf-token"]').attr('content'), action: 'disable' },
                success: function(result) {
                    if (result.status === 1) {
                        location.reload(true)
                    }
                }
            });
        } else {
            return;
        }
    });
    
    // Action when clicking enable button
    $('.enable').on('click', function(){
        if (confirm('Enable : ' + $(this).data('id') + ' ?')) {
            const id = $(this).data('id')
            const href = window.location.pathname + '/' + id
            $.ajax({
                url: href,
                type: 'POST',
                data: { "_token": $('meta[name="csrf-token"]').attr('content'), action: 'enable' },
                success: function(result) {
                    if (result.status === 1) {
                        location.reload(true)
                    }
                }
            });
        } else {
            return;
        }
    });
});