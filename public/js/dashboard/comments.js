$(function()
{

    $(document).on('submit', '#edit-comment-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(typeof result.message !== 'undefined')
            {
                showStatusMessage(result.message, result.messageType);

                if(result.messageType == 'success')
                {
                    ajaxContent($(this).attr('href'), ".ajax-content", false);
                }
            }
            else if(typeof result.errorMessages !== 'undefined')
            {
                showRegisterFormAjaxErrors(result.errorMessages);
            }
        });

        return false;
    }).on('click', '#delete-item', function()
    {
        $('#confirm-modal').modal();
    }).on('click', '.delete-comment .confirm-action', function()
    {

         $.each($('.table tbody tr td input:checkbox:checked'), function()
         {
         	var este = $(this);
            $.ajax(
            {
                "url": window.location.href.toString()+"/"+$(this).data('comment-id'),
                "type": "DELETE"
            }).done(function(result)
            {
                showStatusMessage(result.message, result.messageType);
				$(este).parent().parent().fadeOut('slow');
            });
        });

        $('#confirm-modal').modal('hide');
    });
});