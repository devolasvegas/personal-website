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

        var request = new XMLHttpRequest();
        request.open(method, action, true);
        request.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200) {
                formMessages.textContent = request.response;
            }
        };
        request.send(formData);
        formMessages.textContent = 'Processing . . .'
    })
}