var validacion = {
  validateForm: function() {
    var nomina = document.forms["FormSolicitante"]["nomina"].value;
    var email = document.forms["FormSolicitante"]["email"].value;

    if (nomina == "") {
      alert("Por favor ingrese su nomina");
      return false;
    }

    if (email == "") {
      alert("Por favor ingrese su correo electrónico");
      return false;
    }

    // agregar más validaciones si es necesario

    return true;
  }
}