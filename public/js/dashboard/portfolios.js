$(function()
{

    $(document).on('submit', '#create-portfolio-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "POST",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(result.portfolioCreated === false)
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
    }).on('submit', '#edit-portfolio-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(result.portfolioUpdated === false)
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
    }).on('click', '#delete-item', function()
    {
        $('#confirm-modal').modal();
    }).on('click', '.delete-portfolio .confirm-action', function()
    {

         $.each($('.table tbody tr td input:checkbox:checked'), function()
         {
         	var este = $(this);
            $.ajax(
            {
                "url": window.location.href.toString()+"/"+$(this).data('portfolio-id'),
                "type": "DELETE"
            }).done(function(result)
            {
                showStatusMessage(result.message, result.messageType);
				$(este).parent().parent().fadeOut('slow');
            });
        });

        $('#confirm-modal').modal('hide');
    });
    $('#projects-select').multiSelect();
    $('#user_skills').change(function(){
        if(this.checked) {
            $('#showSkills').removeClass('hidden');
        }else{
            $('#showSkills').addClass('hidden');
        }
    });
    $('#select-all').click(function(){
        $('#projects-select').multiSelect('select_all');
        return false;
    });
    $('#deselect-all').click(function(){
        $('#projects-select').multiSelect('deselect_all');
        return false;
    });

    $('#user_skills').change(function() {
        !$(this).parent().hasClass("checked") ? $("#showSkills").fadeIn() : $("#showSkills").fadeOut();
    });

    $("#addSkill").click(function(e){ //on add input button click
            $("#showSkills").append('<div class="row" id="skillsDiv"><br /><div class="col-xs-2"><input type="text" class="form-control" name="skills[name][]"></div><div class="col-xs-1 input-group float-left"><input type="text" class="form-control right-no-radius" name="skills[percent][]"><span class="input-group-addon">%</span></div><div class="col-xs-2"><span class="input-group-btn"><button class="btn btn-danger btn-flat" type="button" id="removeSkill" style="width:33px">-</button></span></div></div>'); //add input box
    });
    
    $("#showSkills").on("click","#removeSkill", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).closest('div#skillsDiv').fadeOut(function(){$(this).remove();});
    });

    $("#addSocial").click(function(e){ //on add input button click
            $("#socialLinks").parent().parent().append('<div class="row" id="socialDiv"><br /><div class="col-xs-5 width420" id="socialLinks"><select class="form-control right-no-radius width120 float-left btn btn-info" name="social[name][]"><option value="Facebook">Facebook</option><option value="Twitter">Twitter</option><option value="LinkedIn">LinkedIn</option></select><input type="text" class="form-control left-no-radius width260 float-left" name="social[url][]" /></div><div class="col-xs-2"><span class="input-group-btn"><button class="btn btn-danger btn-flat left-18" type="button" style="width:33px" id="removeSocial">-</button></span></div></div>'); //add input box
    });
    

    $("#social").on("click","#removeSocial", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('div#socialDiv').fadeOut(function(){$(this).remove();});
    });
});