function autoGrow(textarea) {
    textarea.style.height = 'auto'; // Reseta a altura
    textarea.style.height = textarea.scrollHeight + 'px'; // Ajusta a altura conforme o conteúdo
}

function countCharacters(textarea) {
    const charCount = textarea.value.length; // Conta o número de caracteres
    document.getElementById('charCount').textContent = `${charCount}/150`; // Atualiza a exibição
}