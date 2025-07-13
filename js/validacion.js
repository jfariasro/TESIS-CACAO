function validarNumero(event) {
    const tecla = event.key;
    if (tecla === 'Enter') {
        return true;
    }
    return /^[0-9]$/.test(tecla) ? true : false;
}

function validarTexto(event) {
    const tecla = event.key;
    if (tecla === 'Enter') {
        return true;
    }
    return /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]$/.test(tecla) ? true : false;
}

function validarDecimal(event) {
    const tecla = event.key;
    if (tecla === 'Enter') {
        return true;
    }
    const input = event.target;
    if (/^\d+(\.\d{0,2})?$/.test(input.value + tecla)) {
        return true;
    }
    return false;
}

function validarUsuario(event) {
    const tecla = event.key;
    if (tecla === 'Enter') {
        return true;
    }
    return /^[a-zA-Z0-9.]$/.test(tecla) ? true : false;
}
