document.getElementById("verificarBtn").addEventListener("click", function() {
    const edad = parseInt(document.getElementById("edad").value);
    const mensaje = edad >= 18 ? "Eres mayor de edad" : "Eres menor de edad";
    document.getElementById("mensaje").innerHTML = mensaje;
});