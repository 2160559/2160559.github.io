 $(document).ready(function() {  
   $("#Region").change(function () {
       selOb=$(" :selected",this).prop("class")
      $("#Provinces").html($("div."+selOb).html())
   });
   
});

var backEventListener = null;

var unregister = function() {
    if ( backEventListener !== null ) {
        document.removeEventListener( 'tizenhwkey', backEventListener );
        backEventListener = null;
        window.tizen.application.getCurrentApplication().exit();
    }
}

//Initialize function
var init = function () {
	
    // register once
    if ( backEventListener !== null ) {
        return;
    }
    
    
    
    var backEvent = function(e) {
        if ( e.keyName == "back" ) {
            try {
                if ( $.mobile.urlHistory.activeIndex <= 0 ) {
                    // if first page, terminate app
                    unregister();
                } else {
                    // move previous page
                    $.mobile.urlHistory.activeIndex -= 1;
                    $.mobile.urlHistory.clearForward();
                    window.history.back();
                }
            } catch( ex ) {
                unregister();
            }
        }
    }
    
    // add eventListener for tizenhwkey (Back Button)
    document.addEventListener( 'tizenhwkey', backEvent );
    backEventListener = backEvent;
    
    validate();
};

window.onload = init;
$(document).unload( unregister );

var validate = function(){	
    
	var nick = new LiveValidation('nick-input', { validMessage: ""});

	nick.add(Validate.Format, {pattern: /^[a-zA-Z]*$/});
	
	var surname = new LiveValidation('surname-input', { validMessage: ""});
	surname.add(Validate.Format, {pattern: /^[a-zA-Z]*$/});

	var confpass = new LiveValidation('confpass-input', { validMessage: ""});
	confpass.add(Validate.Confirmation, { match: 'pass-input' });
	
	var specnumber = new LiveValidation('number-input', { validMessage: ""});
	specnumber.add(Validate.Cpno);
	
	var email = new LiveValidation('mail-input', { validMessage: ""});
	email.add(Validate.Email);
	
	var acceptance = new LiveValidation('accept-input', { validMessage: "OK!"});
	acceptance.add(Validate.Acceptance);
};



$(document).ready(function() {
var select2 = document.getElementById("houseno1"); 
var options2 = []; 
for(var i=1;i<200;i++)
    {
        options2.push(i);
    }
for(var i = 0; i < options2.length; i++) {
    var opt = options2[i];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = opt;
    select2.appendChild(el);
}


  $("#item1").change(function() {
    var value = $(this).val();
    $("#item2").html(options[value]);
  });
    

  $("#item2").change(function() {
      var value = $(this).val();
      $("#item3").html(options1[value]);
  });
    

  
  var options = [
      "<option>Select Province </option><option value='0'>Abra</option><option value='1'>Apayao</option><option value='2'>Benguet</option><option value='3'>Ifugao</option><option value='4'>Kalinga</option><option value='5'>Mountain Province</option>",
      "<option value='0'>Ilocos Norte</option><option value='1'>Ilocos Sur</option><option value='2'>La Union</option><option value='3'>Pangasinan</option>"
  ];


  var options1 = [
  "<option value='0'>Bangued</option><option value='1'>Boliney</option>",
  "<option value='0'>Calanasan</option><option value='1'>Flora</option>",
  "<option value='0'>Atok</option><option value='1'>Baguio</option>","<option value='0'>Aguinaldo</option><option value='1'>Banaue</option>"];
 });




    
    


