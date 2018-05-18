 $(document).ready(function() {  
   $("#Region").change(function () {
       selOb=$(" :selected",this).prop("class")
      $("#Provinces").html($("div."+selOb).html())
   });
   
});
function initialize() {
    var myLatlng = new google.maps.LatLng(16.38418084926152,120.59318745595851);
    var myOptions = {
      zoom: 18,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    var marker = new google.maps.Marker({
        position: myLatlng, 
        map: map,
        draggable:true
    });
    google.maps.event.addListener(
        marker,
        'drag',
        function() {
            document.getElementById('lat').value = marker.position.lat();
            document.getElementById('lng').value = marker.position.lng();
        }
    );
  }
var backEventListener = null;
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display= 'none';

}
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

  $("#item1").change(function() {
    var value = $(this).val();
    $("#item2").html(options[value]);
  });
    

  $("#item2").change(function() {
      var value = $(this).val();
      $("#item3").html(options1[value]);
  });
    

  
  var options = [
      "<option>Select Province </option><option value='Abra'>Abra</option><option value='Apayao'>Apayao</option><option value='Benguet'>Benguet</option><option value='Ifugao'>Ifugao</option><option value='Kalinga'>Kalinga</option><option value='Mountain Province'>Mountain Province</option>",
      "<option value='Ilocos Norte'>Ilocos Norte</option><option value='Ilocos Sur'>Ilocos Sur</option><option value='La Union'>La Union</option><option value='Pangasinan'>Pangasinan</option>"
  ];


  var options1 = [
      "<option value='Bangued'>Bangued</option><option value='Boliney'>Boliney</option>",
      "<option value='Calanasan'>Calanasan</option><option value='Flora'>Flora</option>",
      "<option value='Atok'>Atok</option><option value='Baguio City'>Baguio City</option>","<option value='Aguinaldo'>Aguinaldo</option><option value='Banaue'>Banaue</option>"];
 });




    
    


