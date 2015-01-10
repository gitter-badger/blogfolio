$(document).ready(function()
{
	//editor
	$('textarea').summernote();

	//tags
	$('#tags').tagsInput();

	//multi-select
	$('#projects').multiSelect({keepOrder: true});
	$('#select-all').click(function(){
		$('#projects').multiSelect('select_all');
		return false;
	});
	$('#deselect-all').click(function(){
		$('#projects').multiSelect('deselect_all');
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
    })

    $("#addSocial").click(function(e){ //on add input button click
            $("#socialLinks").parent().parent().append('<div class="row" id="socialDiv"><br /><div class="col-xs-5 width420" id="socialLinks"><select class="form-control right-no-radius width120 float-left btn btn-info" name="social[name][]"><option value="Facebook">Facebook</option><option value="Twitter">Twitter</option><option value="LinkedIn">LinkedIn</option></select><input type="text" class="form-control left-no-radius width260 float-left" name="social[url][]" /></div><div class="col-xs-2"><span class="input-group-btn"><button class="btn btn-danger btn-flat left-18" type="button" style="width:33px" id="removeSocial">-</button></span></div></div>'); //add input box
    });
    

    $("#social").on("click","#removeSocial", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('div#socialDiv').fadeOut(function(){$(this).remove();});
    })
});