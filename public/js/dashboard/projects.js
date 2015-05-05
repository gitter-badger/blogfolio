$(function()
{

    $(document).on('submit', '#create-project-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "POST",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(result.projectCreated === false)
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
                console.log(result.redirectUrl);
            }
        });

        return false;
    }).on('submit', '#edit-project-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(result.projectUpdated === false)
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
    }).on('change', '#file', function(e)
    {
        var files;
        files = e.target.files;
        event.stopPropagation();
        event.preventDefault();

        $('#loaderSpin').fadeIn('slow');
        $('#create-project').addClass('disabled');

        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });
        $.ajax({
            url: '/dashboard/portfolio/projects/uploadFile?files',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR)
            {
                if(typeof data.error === 'undefined')
                {
                   $('#preview_image').attr('src', '/packages/ukadev/blogfolio/uploads/projects/'+data.files[0].split(/(\\|\/)/g).pop());
                   $('#loaderSpin').fadeOut('slow');
                   $('#create-project').removeClass('disabled');   
                   $('#imageName').attr('value',data.files[0].split(/(\\|\/)/g).pop());   
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
            }
        });
     }).on('click', '#delete-item', function()
    {
        $('#confirm-modal').modal();
    }).on('click', '.delete-project .confirm-action', function()
    {

         $.each($('.table tbody tr td input:checkbox:checked'), function()
         {
            var este = $(this);
            $.ajax(
            {
                "url": window.location.href.toString()+"/"+$(this).data('project-id'),
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