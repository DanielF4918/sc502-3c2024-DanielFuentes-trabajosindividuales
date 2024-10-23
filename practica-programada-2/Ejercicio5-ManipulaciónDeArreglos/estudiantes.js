document.addEventListener("DOMContentLoaded", function() {
    const estudiantes = [
        { nombre: "Daniel", apellido: "Fuentes Giró", nota: 89 },
        { nombre: "Jefferson", apellido: "Briceño Días", nota: 100 },
        { nombre: "Kevin", apellido: "Araya Cordero", nota: 72 }
    ];

    mostrarEstudiantes();

    function mostrarEstudiantes() {
        let lista = "";
        let sumaNotas = 0;

        estudiantes.forEach(estudiante => {
            lista += `<p>${estudiante.nombre} ${estudiante.apellido} - Nota: ${estudiante.nota}</p>`;
            sumaNotas += estudiante.nota;
        });

        const promedio = sumaNotas / estudiantes.length;
        lista += `<p><strong>Promedio de Notas:</strong> ${promedio.toFixed(2)}</p>`;

        document.getElementById("listaEstudiantes").innerHTML = lista;
    }
});