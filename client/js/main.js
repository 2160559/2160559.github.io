
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

var validate = function(){
    let f_name = new LiveValidation('f_name', { validMessage: ""});
    f_name.add(Validate.format, {pattern: /^[a-zA-Z]*$/});
	let l_name = new LiveValidation('l_name', { validMessage: ""});
	l_name.add(Validate.Format, {pattern: /^[a-zA-Z]*$/});

	let confpass = new LiveValidation('confpass', { validMessage: ""});
	confpass.add(Validate.Confirmation, { match: 'password' });

};




    
    


