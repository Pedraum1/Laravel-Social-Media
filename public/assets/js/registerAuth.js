var toggle = false;
const passInput = document.getElementById('password');
const confirmationInput = document.getElementById('confirmation');
const toggleButton = document.getElementById('toggle');

function togglePass(){
    if(toggle == false){
        passInput.type = "text";
        confirmationInput.type = "text";
        toggleButton.classList.add('fa-eye-slash');
        toggleButton.classList.remove('fa-eye');
    }
    if(toggle == true){
        passInput.type = "password";
        confirmationInput.type = "password";
        toggleButton.classList.add('fa-eye');
        toggleButton.classList.remove('fa-eye-slash');
    }
    toggle = !toggle;
}