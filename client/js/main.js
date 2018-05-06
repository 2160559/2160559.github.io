var backEventListener = null;

var unregister = function () {
    if (backEventListener !== null) {
        document.removeEventListener('tizenhwkey', backEventListener);
        backEventListener = null;
        window.tizen.application.getCurrentApplication().exit();
    }
}

//Initialize function
var init = function () {

    // register once
    if (backEventListener !== null) {
        return;
    }


    var backEvent = function (e) {
        if (e.keyName == "back") {
            try {
                if ($.mobile.urlHistory.activeIndex <= 0) {
                    // if first page, terminate app
                    unregister();
                } else {
                    // move previous page
                    $.mobile.urlHistory.activeIndex -= 1;
                    $.mobile.urlHistory.clearForward();
                    window.history.back();
                }
            } catch (ex) {
                unregister();
            }
        }
    }

    // add eventListener for tizenhwkey (Back Button)
    document.addEventListener('tizenhwkey', backEvent);
    backEventListener = backEvent;

    validate();
};

window.onload = init;
$(document).unload(unregister);

var validate = function () {
    var surname = new LiveValidation('firstname', {validMessage: ""});
    surname.add(Validate.Format, {pattern: /^[a-zA-Z]*$/});

    var surname = new LiveValidation('lastname', {validMessage: ""});
    surname.add(Validate.Format, {pattern: /^[a-zA-Z]*$/});

    var confpass = new LiveValidation('confirm_password', {validMessage: ""});
    confpass.add(Validate.Confirmation, {match: 'pass-input'});

    var specnumber = new LiveValidation('phone', {validMessage: ""});
    specnumber.add(Validate.Cpno);

    var email = new LiveValidation('email', {validMessage: ""});
    email.add(Validate.Email);
    var password = new LiveValidation('password', {validMessage: ""});
    password.add(Validate.Length, {minimum: 8, maximumm: 32})
};
var validateUsername = function (usernames) {
    var username = new LiveValidation('username', {validMessage: "Valid"});
    username.add(Validate.Inclusion, usernames);
}




    
    


