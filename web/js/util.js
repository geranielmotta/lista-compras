function cambiar_login() {
  $('#emailLogin').attr("required", "required");
  $('#passwordLogin').attr("required", "required");

  $('#nameNewUser').removeAttr("required", "required");
  $('#emailNewUser').removeAttr("required", "required");
  $('#passwordNewUser').removeAttr("required", "required");

  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";  
  document.querySelector('.cont_form_login').style.display = "block";
  document.querySelector('.cont_form_sign_up').style.opacity = "0";               
  
  setTimeout(function(){  document.querySelector('.cont_form_login').style.opacity = "1"; },400);  
    
  setTimeout(function(){    
  document.querySelector('.cont_form_sign_up').style.display = "none";
  },200);  
    }
  
  function cambiar_sign_up(at) {
    $('#emailLogin').removeAttr("required", "required");
    $('#passwordLogin').removeAttr("required", "required");

    $('#nameNewUser').attr("required", "required");
    $('#emailNewUser').attr("required", "required");
    $('#passwordNewUser').attr("required", "required");

  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
  document.querySelector('.cont_form_sign_up').style.display = "block";
  document.querySelector('.cont_form_login').style.opacity = "0";
    
  setTimeout(function(){  document.querySelector('.cont_form_sign_up').style.opacity = "1";
  },100);  
  
  setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
  },400);  
  
  
  }    
  
  
  function ocultar_login_sign_up() {
  
  document.querySelector('.cont_forms').className = "cont_forms";  
  document.querySelector('.cont_form_sign_up').style.opacity = "0";               
  document.querySelector('.cont_form_login').style.opacity = "0"; 
  
  setTimeout(function(){
  document.querySelector('.cont_form_sign_up').style.display = "none";
  document.querySelector('.cont_form_login').style.display = "none";
  },500);  
    
    }