import $ from 'jquery';

$(document).ready(function(){
    $(document).on('submit','.actionForm', function(e) {
        e.preventDefault();
        $.ajax({
            type        : 'POST',
            url         : $(this).attr('action'),
            data        : $(this).serialize(),
            success     : function()
            {
                window.location.reload();
            }
        });
            // .done(function(response) {
            //     window.location.reload();
            // })
            // .fail(function() {
            //     alert( "error" );
            // });
        return  false;
    });
});