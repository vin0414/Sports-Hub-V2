//fetch
$('#category').change(function(){
    $('#salary_grade').find('option:not(:first)').remove();
    $.ajax({
        url:window.location.origin +"/fetch-category-grades",
        method:"GET",
        data:{value:$(this).val()},
        success:function(response)
        {
            $('#salary_grade').append(response);
        }
    });
});

const radioCourse = document.querySelectorAll('input[name="course_require"]');
for(var i = 0, max = radioCourse.length; i < max; i++) {
    radioCourse[i].onclick = function() {
        if(this.value==1){document.getElementById("course").required=true;}
        else{document.getElementById("course").required=false;
            document.getElementById('course').selectedIndex = 0;
        }
    }
}

const radioTraining = document.querySelectorAll('input[name="training_require"]');
for(var i = 0, max = radioTraining.length; i < max; i++) {
    radioTraining[i].onclick = function() {
        if(this.value==1){document.getElementById("training").required=true;}
        else{document.getElementById("training").required=false;document.getElementById('training').selectedIndex = 0;}
    }
}

const radioExperience = document.querySelectorAll('input[name="experience_require"]');
for(var i = 0, max = radioExperience.length; i < max; i++) {
    radioExperience[i].onclick = function() {
        if(this.value==1){document.getElementById("experience").required=true;}
        else{document.getElementById("experience").required=false;document.getElementById('experience').selectedIndex = 0;}
    }
}

const radioEligibility = document.querySelectorAll('input[name="eligibility_require"]');
for(var i = 0, max = radioEligibility.length; i < max; i++) {
    radioEligibility[i].onclick = function() {
        if(this.value==1){document.getElementById("eligibility").required=true;}
        else{document.getElementById("eligibility").required=false;document.getElementById('eligibility').selectedIndex = 0;}
    }
}

const radioCompetence = document.querySelectorAll('input[name="competency_require"]');
for(var i = 0, max = radioCompetence.length; i < max; i++) {
    radioCompetence[i].onclick = function() {
        if(this.value==1){document.getElementById("competency").required=true;}
        else{document.getElementById("competency").required=false;document.getElementById("competency").value="";}
    }
}