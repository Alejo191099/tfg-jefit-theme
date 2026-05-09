<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora IMC - jefit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 fw-bold">Calcula tu IMC</h2>

                        <div class="mb-3">
                            <label for="peso" class="form-label">Peso (kg)</label>
                            <input type="number" id="peso" class="form-control" min="20" max="300" step="0.1" placeholder="Ej: 75">
                        </div>

                        <div class="mb-3">
                            <label for="altura" class="form-label">Altura (cm)</label>
                            <input type="number" id="altura" class="form-control" min="100" max="250" step="1" placeholder="Ej: 180">
                        </div>

                        <button type="button" onclick="calcularIMC()" class="btn btn-dark w-100 py-2 mt-3">Calcular</button>

                        <div id="resultado" class="alert alert-secondary mt-4 text-center d-none fw-bold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calcularIMC() {
            // Paso los valores a número para poder hacer cálculos de verdad.
            const peso = parseFloat(document.getElementById('peso').value);
            const altura = parseFloat(document.getElementById('altura').value);

            // Estos límites evitan resultados absurdos, por ejemplo una altura de 890 cm.
            const pesoMinimo = 20;
            const pesoMaximo = 300;
            const alturaMinima = 100;
            const alturaMaxima = 250;

            if (isNaN(peso) || isNaN(altura)) {
                mostrarMensaje('Escribe tu peso y tu altura para poder calcular el IMC.', 'warning');
                return;
            }

            if (peso < pesoMinimo || peso > pesoMaximo) {
                mostrarMensaje('El peso debe estar entre 20 kg y 300 kg.', 'warning');
                return;
            }

            if (altura < alturaMinima || altura > alturaMaxima) {
                mostrarMensaje('La altura debe estar entre 100 cm y 250 cm.', 'warning');
                return;
            }

            // La fórmula usa la altura en metros, por eso divido los centímetros entre 100.
            const alturaMetros = altura / 100;
            const imc = peso / (alturaMetros * alturaMetros);
            const imcRedondeado = imc.toFixed(1);

            let categoria = '';

            if (imc < 18.5) {
                categoria = 'bajo peso';
            } else if (imc < 25) {
                categoria = 'peso normal';
            } else if (imc < 30) {
                categoria = 'sobrepeso';
            } else {
                categoria = 'obesidad';
            }

            mostrarMensaje('Tu IMC es ' + imcRedondeado + ' (' + categoria + ').', 'success');
        }

        function mostrarMensaje(texto, tipo) {
            const resultadoDiv = document.getElementById('resultado');

            // Quito clases anteriores para que no se mezclen colores al repetir el cálculo.
            resultadoDiv.classList.remove('d-none', 'alert-secondary', 'alert-success', 'alert-warning', 'alert-danger');
            resultadoDiv.classList.add('alert-' + tipo);
            resultadoDiv.textContent = texto;
        }
    </script>

</body>
</html>
