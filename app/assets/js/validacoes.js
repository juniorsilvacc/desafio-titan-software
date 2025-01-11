function validarLogin() {
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;

    var erroMsg = "";
    
    // Verificação se o email está no formato correto
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!regex.test(email)) {
        erroMsg = "Por favor, insira um email válido.";
    }
    
    if (senha === "") {
        erroMsg = "Por favor, insira a senha.";
    }

    if (erroMsg !== "") {
        document.getElementById("erro_msg").innerText = erroMsg;
        return false;
    }
    
    return true;
}
