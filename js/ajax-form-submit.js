(function(){

    // This script will handle ajax submission of the contact form
    // If the client has JS disabled, the PHP script will still function

    var contactForm = document.querySelector('#contact-form');
    var formMessages = document.querySelector('#form-messages');
    var action = contactForm.getAttribute('action');
    var method = contactForm.getAttribute('method');

    contactForm.addEventListener('submit', function(e){

        e.preventDefault();

        var formData = new FormData(contactForm);

        // This is a flag used in the PHP script for control flow
        // TODO: Remove is-ajax from form
        formData.set('is-ajax', true);

        // No ketchup. Just raw sauce.
        var request = new XMLHttpRequest();
        request.open(method, action, true);
        request.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200) {
                var theResponse = JSON.parse(request.response);
                formMessages.innerHTML = theResponse.formMessage;
                var inputs = contactForm.querySelectorAll('[name]');

                // Loop over the inputs to see if there is an error sent back from the server
                for(var i = 0; i < inputs.length; i++) {
                    var input = inputs[i];
                    var inputName = input.getAttribute('name');

                    // If there is an error, apply error styling to the input.
                    if(theResponse[inputName]) {
                        input.classList.add('error');
                    } else {
                        input.classList.remove('error');
                    }
                }
            }
        };
        request.send(formData);
        formMessages.textContent = 'Processing . . .'
    });

})();

