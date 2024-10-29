var toggle = false;
const passInput = document.getElementById('password');
const toggleButton = document.getElementById('toggle');

toggleButton.addEventListener('click',function(){
    if(toggle == false){
        passInput.type = "text";
        toggleButton.classList.add('fa-eye-slash');
        toggleButton.classList.remove('fa-eye');
    }
    if(toggle == true){
        passInput.type = "password";
        toggleButton.classList.add('fa-eye');
        toggleButton.classList.remove('fa-eye-slash');
    }
    toggle = !toggle;
    
});