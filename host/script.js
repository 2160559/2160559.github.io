/* ----------------------------

	CustomValidation prototype

	- Keeps track of the list of invalidity messages for this input
	- Keeps track of what validity checks need to be performed for this input
	- Performs the validity checks and sends feedback to the front end

---------------------------- */

function CustomValidation(input) {
	this.invalidities = [];
	this.validityChecks = [];

	//add reference to the input node
	this.inputNode = input;

	//trigger method to attach the listener
	this.registerListener();
}

CustomValidation.prototype = {
	addInvalidity: function(message) {
		this.invalidities.push(message);
	},
	getInvalidities: function() {
		return this.invalidities.join('. \n');
	},
	checkValidity: function(input) {
		for ( var i = 0; i < this.validityChecks.length; i++ ) {

			var isInvalid = this.validityChecks[i].isInvalid(input);
			if (isInvalid) {
				this.addInvalidity(this.validityChecks[i].invalidityMessage);
			}

			var requirementElement = this.validityChecks[i].element;

			if (requirementElement) {
				if (isInvalid) {
					requirementElement.classList.add('invalid');
					requirementElement.classList.remove('valid');
				} else {
					requirementElement.classList.remove('invalid');
					requirementElement.classList.add('valid');
				}

			} // end if requirementElement
		} // end for
	},
	checkInput: function() { // checkInput now encapsulated

		this.inputNode.CustomValidation.invalidities = [];
		this.checkValidity(this.inputNode);

		if ( this.inputNode.CustomValidation.invalidities.length === 0 && this.inputNode.value !== '' ) {
			this.inputNode.setCustomValidity('');
		} else {
			var message = this.inputNode.CustomValidation.getInvalidities();
			this.inputNode.setCustomValidity(message);
		}
	},
	registerListener: function() { //register the listener here

		var CustomValidation = this;

		this.inputNode.addEventListener('keyup', function() {
			CustomValidation.checkInput();
		});


	}

};



/* ----------------------------

	Validity Checks

	The arrays of validity checks for each input
	Comprised of three things
		1. isInvalid() - the function to determine if the input fulfills a particular requirement
		2. invalidityMessage - the error message to display if the field is invalid
		3. element - The element that states the requirement

---------------------------- */

var firstnameValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 1;
		},
		invalidityMessage: 'This input needs to be at least a character',
		element: document.querySelector('label[for="firstname"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
              var letters = /^[A-Za-z]+$/;
              if(input.value.match(letters))
              {
                  
               return false;
                  
              }
              else if(input.value.length < 1)
              {
                  invalidityMessage: 'This input needs to be at least a character';
                return false;
              }
              else{
                  
                   window.alert('Only letters are allowed');
              document.getElementById('firstname').value = '';
              return false;
              }
          
		},
		invalidityMessage: 'Only letters are allowed',
		element: document.querySelector('label[for="firstname"] .input-requirements li:nth-child(2)')
	}
];
var lastnameValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 1;
		},
		invalidityMessage: 'This input needs to be at least a character',
		element: document.querySelector('label[for="lastname"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
              var letterss = /^[A-Za-z]+$/;
              if(input.value.match(letterss))
              {
                  
               return false;
                  
              }
              else if(input.value.length < 1)
              {
                invalidityMessage: 'This input needs to be at least a character';
                return false;
              }
              else{
                  
                   window.alert('Only letters are allowed');
              document.getElementById('lastname').value = '';
              return false;
              }
          
		},
		invalidityMessage: 'Only letters are allowed',
		element: document.querySelector('label[for="lastname"] .input-requirements li:nth-child(2)')
	}
];

$('#some_selector').html(select);
var emailValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 1;
		},
		invalidityMessage: 'This input needs an e-mail address',
		element: document.querySelector('label[for="email"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
              
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var xa=re.test(String(input).toLowerCase());
            if(input.value.match(re))
                {
                    
                    return false;
                }
            else{
                
                 
                
                   return  true; 
            }
          
		},
		invalidityMessage: 'This input needs an e-mail address',
		element: document.querySelector('label[for="email"] .input-requirements li:nth-child(2)')
	}
];

var usernameValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 3;
		},
		invalidityMessage: 'This input needs to be at least 3 characters',
		element: document.querySelector('label[for="username"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z0-9]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only letters and numbers are allowed',
		element: document.querySelector('label[for="username"] .input-requirements li:nth-child(2)')
	}
];

var contactnoValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 12;
		},
		invalidityMessage: 'This input needs to be 12 characters',
		element: document.querySelector('label[for="contactno"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			if(input.startsWith("+63"))
                {
                    window.alert('Only letters are allowed');
                    return false;
                }
            else{
                return true;
            }
             
			//return n ? true : false;
		},
		invalidityMessage: 'Only letters numbers and '+' are allowed',
		element: document.querySelector('label[for="contactno"] .input-requirements li:nth-child(2)')
	}
];


var passwordValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 8 | input.value.length > 100;
		},
		invalidityMessage: 'This input needs to be between 8 and 100 characters',
		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[0-9]/g);
		},
		invalidityMessage: 'At least 1 number is required',
		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(2)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[a-z]/g);
		},
		invalidityMessage: 'At least 1 lowercase letter is required',
		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(3)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[A-Z]/g);
		},
		invalidityMessage: 'At least 1 uppercase letter is required',
		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(4)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[\!\@\#\$\%\^\&\*]/g);
		},
		invalidityMessage: 'You need one of the required special characters',
		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(5)')
	}
];

var passwordRepeatValidityChecks = [
	{
		isInvalid: function() {
			return passwordRepeatInput.value != passwordInput.value;
		},
		invalidityMessage: 'This password needs to match the first one'
	}
];


/* ----------------------------

	Setup CustomValidation

	Setup the CustomValidation prototype for each input
	Also sets which array of validity checks to use for that input

---------------------------- */

var usernameInput = document.getElementById('username');
var firstnameInput = document.getElementById('firstname');
var lastnameInput = document.getElementById('lastname');
var passwordInput = document.getElementById('password');
var passwordRepeatInput = document.getElementById('password_repeat');

usernameInput.CustomValidation = new CustomValidation(usernameInput);
usernameInput.CustomValidation.validityChecks = usernameValidityChecks;

lastnameInput.CustomValidation = new CustomValidation(lastnameInput);
lastnameInput.CustomValidation.validityChecks = lastnameValidityChecks;

emailInput.CustomValidation = new CustomValidation(emailInput);
emailnameInput.CustomValidation.validityChecks = emailValidityChecks;

firstnameInput.CustomValidation = new CustomValidation(firstnameInput);
firstnameInput.CustomValidation.validityChecks = firstnameValidityChecks;

passwordInput.CustomValidation = new CustomValidation(passwordInput);
passwordInput.CustomValidation.validityChecks = passwordValidityChecks;

passwordRepeatInput.CustomValidation = new CustomValidation(passwordRepeatInput);
passwordRepeatInput.CustomValidation.validityChecks = passwordRepeatValidityChecks;


contactnoInput.CustomValidation = new CustomValidation(contactnoInput);
contactnoInput.CustomValidation.validityChecks = contactnoValidityChecks;


/* ----------------------------

	Event Listeners

---------------------------- */

var inputs = document.querySelectorAll('input:not([type="submit"])');


var submit = document.querySelector('input[type="submit"');
var form = document.getElementById('registration');

function validate() {
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].CustomValidation.checkInput();
	}
}

submit.addEventListener('click', validate);
form.addEventListener('submit', validate);
