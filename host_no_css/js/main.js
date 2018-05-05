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
//var select = document.getElementById("houseno1"); 
var options2 = [];

for(var y = 1; y <= 100; y++){
    options2.push(y);

}
var d="a";

var cp = ["Select Province","Abra", "Benguet", "Kalinga", "Apayao", "Mountain Province","Ifugao" ]; 
var r1=["Ilocos Norte","Ilocos Sur","La Union","Pangasinan"];
var select="";
var citiesBenguet=[    "Atok","Baguio","Bakun","Boko","Bugias","Itogon","Kabayan","Kapangan","Kibungan","La Trinidad","Mankayan","Sablan","Tuba","Tublay"];
var citiesAbra=["Bangued","Boliney","Bucay"];
//var city=document.getElementById("city").value;
var checkProvince="";
function val() {
    
    d=document.getElementById("Region").value;
   
    if(d=="CAR"){
       select  = document.getElementById("car-prov"); 
        determiner(cp,select); 
       
        
    }
    else{
 
       select = document.getElementById("r1-prov");
        determiner(r1,select);
    }
    
   
}

function val2(){
var selecta1 = document.getElementById("Provinces").value;
    console.log(selecta1);
     var myobject = {
    ValueA : 'Text A',
    ValueB : 'Text B',
    ValueC : 'Text C'
};
var selecta = document.getElementById("city");
for(index in myobject) {
    selecta.options[selecta.options.length] = new Option(myobject[index], index);
}
}



function determiner(a,b)
{    
    for(var i = 0; i < a.length; i++) {
    var opt = a[i];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = el;
    b.appendChild(el);

}
    
    
}

