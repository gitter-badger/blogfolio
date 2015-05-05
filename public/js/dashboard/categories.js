$(function()
{

    $(document).on('submit', '#create-category-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "POST",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(result.postCreated === false)
            {
                if(typeof result.message !== 'undefined')
                {
                    showStatusMessage(result.message, result.messageType);
                }
                else if(typeof result.errorMessages !== 'undefined')
                {
                    showRegisterFormAjaxErrors(result.errorMessages);
                }
            }
            else
            {
                window.location = result.redirectUrl;
            }
        });

        return false;
    }).on('submit', '#edit-category-form', function()
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
    }).on('click', '.delete-category .confirm-action', function()
    {

         $.each($('.table tbody tr td input:checkbox:checked'), function()
         {
         	var este = $(this);
            $.ajax(
            {
                "url": window.location.href.toString()+"/"+$(this).data('category-id'),
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