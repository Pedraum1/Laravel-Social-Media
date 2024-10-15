document.getElementById('toggleSenha').addEventListener('click', function () {
    let inputSenha = document.getElementById('passInput');
    let tipo = inputSenha.getAttribute('type');
  
    if (tipo === 'password') {
        inputSenha.setAttribute('type', 'text');
        this.classList.add('fa-eye-slash');
        this.classList.remove('fa-eye');
    } else {
        inputSenha.setAttribute('type', 'password');
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
  });