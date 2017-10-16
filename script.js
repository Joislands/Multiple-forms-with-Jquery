$(document).ready(function(){
    //group add limit
    var maxGroup = Infinity;
    
    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('There is no alert, we are infinity');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });

});

//VALIDATION OF FIELDS

//getting the field inputs in objects
var name = document.forms["infiniteform"]["name"];
var email = document.forms["infiniteform"]["email"];
var postcode = document.forms["infiniteform"]["postcode"];
//set the errors variables
var name_error = document.getElementById("name_error");
var email_error = document.getElementById("email_error");
var postcode_error = document.getElementById("postcode_error");

//do the javascript tricks

name.addEventListener("blur", nameVerify, true);
email.addEventListener("blur", emailVerify, true);
name.addEventListener("blur", postcodeVerify, true);

function Validate(){
    //validate the name
    if(name.value =="") {
        name.style.border = "2px dashed red";
        name_error.textContent = "Name?";
        name.focus();
        return false;
    }
    //validate the email
    if(email.value =="") {
        email.style.border = "2px dashed red";
        email_error.textContent = "is this an email?";
        email.focus();
        return false;
    }
    //validate the postcode
    if(postcode.value =="") {
        postcode.style.border = "2px dashed red";
        postcode_error.textContent = "password is required";
        postcode.focus();
        return false;
    }
}
//event handler
    function nameVerify(){
        if(name.value !=""){
        name.style.border = "2px dashed green";
        name_error.innerHTML = "";
        return true;
    }
}
    function emailVerify(){
        if(email.value !=""){
        email.style.border = "2px dashed green";
        email_error.innerHTML = "";
        return true;
    }
}
    function postcodeVerify(){
        if(postcode.value !=""){
        postcode.style.border = "2px dashed green";
        postcode_error.innerHTML = "";
        return true;
    }

}
