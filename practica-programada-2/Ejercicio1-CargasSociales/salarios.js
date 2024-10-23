function calcularDeducciones() {
    const salarioBruto = parseFloat(document.getElementById("salario").value);

    if (isNaN(salarioBruto) || salarioBruto <= 0) {
        document.getElementById("resultado").innerHTML = `<p>Por favor ingrese un salario válido.</p>`;
        return;
    }

    const CCSS = salarioBruto * 0.1067;
    const SEM = salarioBruto * 0.055;
    const IVM = salarioBruto * 0.0417; 

    const cargasSocialesTotales = CCSS + SEM + IVM;

    let impuestoRenta = 0;

    if (salarioBruto > 4783000) {
        impuestoRenta = (salarioBruto - 4783000) * 0.25;
    } else if (salarioBruto > 2392000) {
        impuestoRenta = (salarioBruto - 2392000) * 0.20;
    } else if (salarioBruto > 1363000) {
        impuestoRenta = (salarioBruto - 1363000) * 0.15;
    } else if (salarioBruto > 929000) {
        impuestoRenta = (salarioBruto - 929000) * 0.10;
    }

    const salarioNeto = salarioBruto - cargasSocialesTotales - impuestoRenta;

    document.getElementById("resultado").innerHTML = `
        <p>CCSS (10.67%): ₡${CCSS.toFixed(2)}</p>
        <p>SEM (5.50%): ₡${SEM.toFixed(2)}</p>
        <p>IVM (4.17%): ₡${IVM.toFixed(2)}</p>
        <p><strong>Cargas Sociales Totales: ₡${cargasSocialesTotales.toFixed(2)}</strong></p>
        <p>Impuesto sobre la Renta: ₡${impuestoRenta.toFixed(2)}</p>
        <p><strong>Salario Neto: ₡${salarioNeto.toFixed(2)}</strong></p>
    `;
}