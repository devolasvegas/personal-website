(function(){
    ajaxFormSubmit();
})();

function ajaxFormSubmit(){
    var contactForm = document.querySelector('#contact-form');
    var formMessages = document.querySelector('#form-messages');
    var action = contactForm.getAttribute('action');
    var method = contactForm.getAttribute('method');

    contactForm.addEventListener('submit', function(e){

        e.preventDefault();

        var formData = new FormData(contactForm);
        formData.set('is-ajax', true);

        var request = new XMLHttpRequest();
        request.open(method, action, true);
        request.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200) {
                var theResponse = JSON.parse(request.response);
                formMessages.innerHTML = theResponse.formMessage;
                var inputs = contactForm.querySelectorAll('[name]');
                for(var i = 0; i < inputs.length; i++) {
                    var input = inputs[i];
                    var inputName = input.getAttribute('name');
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
    })
}