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
	console.log("init() called");
    // register once
    if ( backEventListener !== null ) {
        return;
    }
    
    console.log("init() called");
    
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
	var nick = new LiveValidation('nick-input', { validMessage: "Valid!"});

	nick.add(Validate.Format, {pattern: /^[a-zA-Z][0-9a-zA-Z]{7,15}$/});
	
	var surname = new LiveValidation('surname-input', { validMessage: "Valid!"});
	surname.add(Validate.Length, {minimum: 3, maximum: 25});

	var confpass = new LiveValidation('confpass-input', { validMessage: "Valid!"});
	confpass.add(Validate.Confirmation, { match: 'pass-input' });
	
	var specnumber = new LiveValidation('number-input', { validMessage: "Valid!"});
	specnumber.add(Validate.Numericality, { minimum: 1, maximum: 30, onlyInteger: true });
	
	var email = new LiveValidation('mail-input', { validMessage: "Valid!"});
	email.add(Validate.Email);
	
	var acceptance = new LiveValidation('accept-input', { validMessage: "OK!"});
	acceptance.add(Validate.Acceptance);
};