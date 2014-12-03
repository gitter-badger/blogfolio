$(function()
{

    $(document).on('submit', '#update-settings-form', function()
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
                	console.log($(this).attr('href'));
                    ajaxContent($(this).attr('href'), ".ajax-content", false);
                }
            }
            else if(typeof result.errorMessages !== 'undefined')
            {
                showRegisterFormAjaxErrors(result.errorMessages);
            }
        });

        return false;
    });
});