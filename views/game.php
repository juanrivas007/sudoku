<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../controllers/GameController.php';

$username = sanitizeInput($_GET['username'] ?? '');
$difficulty = sanitizeInput($_GET['difficulty'] ?? '');
if (!$username || !$difficulty) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Redireccionando...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Datos faltantes',
                text: 'Debes ingresar un nombre de usuario y seleccionar una dificultad.',
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>
    </body>
    </html>";
    exit;
}

$gameData = GameController::getGameBoard($difficulty);
$board = $gameData['board'];
$solution = $gameData['solution'];

// Consultar el ranking del nivel actual
$query_ranking = "SELECT username, time_taken FROM scores WHERE difficulty = ? ORDER BY time_taken ASC LIMIT 5";
$stmt = $conn->prepare($query_ranking);
$stmt->bind_param('s', $difficulty);
$stmt->execute();
$result = $stmt->get_result();
$ranking = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku - Juego</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3276673848599493"
     crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar izquierdo -->
            <aside class="col-md-3 order-md-1 order-2">
                <div class="mb-4">
                    <h5 style="color: <?php 
                        echo $difficulty === 'easy' ? 'var(--bright-pink-crayola)' :
                            ($difficulty === 'medium' ? 'var(--vermilion)' : 'var(--rosewood)'); ?>;
                        font-family: 'Arial Black', sans-serif;">
                        Ranking nivel <?= htmlspecialchars($difficulty) ?>
                    </h5>

                    <ul class="list-group">
                        <?php foreach ($ranking as $index => $entry): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="font-family: 'Verdana', sans-serif;">
                                <span>
                                    <?php if ($index === 0): ?>
                                        <i class="fas fa-crown" style="color: gold;"></i>
                                    <?php elseif ($index === 1): ?>
                                        <i class="fas fa-medal" style="color: silver;"></i>
                                    <?php elseif ($index === 2): ?>
                                        <i class="fas fa-award" style="color: bronze;"></i>
                                    <?php else: ?>
                                        <i class="fas fa-star" style="color: var(--bright-pink-crayola);"></i>
                                    <?php endif; ?>
                                    <?= htmlspecialchars($entry['username']) ?>
                                </span>
                                <span class="badge" style="background-color: var(--bright-pink-crayola); color: var(--lavender-blush); font-size: 1.2rem;">
                                    <?= gmdate('i:s', $entry['time_taken']) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <h5 style="color: var(--licorice);">Ads</h5>
                    <div id="google-ads-1" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 150px; color: var(--licorice);">Google Ads 1</p>
                    </div>
                    <div id="google-ads-2" class="mt-3" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 150px; color: var(--licorice);">Google Ads 2</p>
                    </div>
                </div>
            </aside>

            <!-- Contenido principal -->
            <main class="col-md-6 order-md-2 order-1">
                <!-- Encabezado -->
                <div class="text-center mb-4">
                    <h1 class="display-5" style="color: var(--bright-pink-crayola);">
                        ¡Buena suerte, <?= htmlspecialchars($username) ?>!
                    </h1>
                </div>

                <!-- Cronómetro -->
                <div id="timer" class="text-center mb-4">
                    <h3 style="color: var(--licorice);">Tiempo: <span id="time-elapsed">00:00</span></h3>
                </div>

                <!-- Tablero de Sudoku -->
                <div id="sudoku-board" class="sudoku-grid">
                    <?php foreach ($board as $rowIndex => $row): ?>
                        <?php foreach ($row as $colIndex => $cell): ?>
                            <input
                                type="text"
                                maxlength="1"
                                class="sudoku-cell"
                                data-row="<?= $rowIndex ?>"
                                data-col="<?= $colIndex ?>"
                                value="<?= $cell ?: '' ?>"
                                <?= $cell ? 'readonly' : '' ?>
                            >
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    <button id="hint-button" class="btn btn-info btn-lg" style="background-color: var(--licorice); color: var(--lavender-blush);">Sugerencia</button>
                    <button id="finish-game" class="btn btn-success btn-lg" style="background-color: var(--bright-pink-crayola); color: var(--lavender-blush);">Finalizar</button>
                    <button id="show-solution" class="btn btn-warning btn-lg" style="background-color: var(--vermilion); color: var(--lavender-blush);">Mostrar solución</button>
                    <button id="back-to-index" class="btn btn-danger btn-lg" style="background-color: var(--rosewood); color: var(--lavender-blush);">Volver al inicio</button>
                </div>

            </main>  
            
            <!-- Sidebar derecho -->
            <aside class="col-md-3 order-md-3 order-3">
                <div class="mb-4">
                    <h5 style="color: var(--licorice);">Ads</h5>
                    <div class="banner mb-3" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 150px; color: var(--licorice);">Banner 1</p>
                    </div>
                    <div class="banner" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 150px; color: var(--licorice);">Banner 2</p>
                    </div>
                </div>
                <div>
                    <div id="google-ads" style="height: 300px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 300px; color: var(--licorice);">Google Ads</p>
                    </div>
                </div>
            </aside>
            
        </div>        
    </div>

     <!-- Footer -->
     <footer class="text-center py-3 mt-5" style="background-color: var(--licorice); color: var(--lavender-blush);">
        &copy; 2018 Whatever. Todos los derechos reservados.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const finishButton = document.getElementById('finish-game');
            const solutionButton = document.getElementById('show-solution');
            const backToIndexButton = document.getElementById('back-to-index');
            const cells = document.querySelectorAll('.sudoku-cell');
            const timerElement = document.getElementById('time-elapsed');
            let elapsedSeconds = 0;

            // Cronómetro
            const interval = setInterval(() => {
                elapsedSeconds++;
                const minutes = Math.floor(elapsedSeconds / 60).toString().padStart(2, '0');
                const seconds = (elapsedSeconds % 60).toString().padStart(2, '0');
                document.getElementById('time-elapsed').textContent = `${minutes}:${seconds}`;
            }, 1000);

            // Validar entrada: sólo números del 1 al 9
            cells.forEach(cell => {
                cell.addEventListener('input', () => {
                    const value = cell.value.trim();
                    if (!/^[1-9]$/.test(value)) {
                        cell.value = ''; // Limpiar entrada inválida
                    }
                });
            });

            // Validar si el tablero está completo
            function isBoardComplete() {
                for (const cell of cells) {
                    if (!cell.value.trim()) {
                        return false;
                    }
                }
                return true;
            }

            // Validar si el tablero es correcto
            function isBoardCorrect() {
                const board = Array.from({ length: 9 }, () => Array(9).fill(0));

                cells.forEach(cell => {
                    const row = parseInt(cell.dataset.row, 10);
                    const col = parseInt(cell.dataset.col, 10);
                    const value = parseInt(cell.value, 10) || 0;
                    board[row][col] = value;
                });

                return JSON.stringify(board) === '<?= json_encode($solution) ?>';
            }

            // Confirmación antes de volver al inicio
            backToIndexButton.addEventListener('click', () => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Si sales, perderás el progreso actual.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, salir',
                    cancelButtonText: 'Cancelar'
                }).then(result => {
                    if (result.isConfirmed) {
                        clearInterval(interval); // Detener cronómetro
                        window.location.href = '<?= BASE_URL ?>views/index.php';
                    }
                });
            });

            // Manejar el clic en "Finalizar"
            finishButton.addEventListener('click', () => {
                if (!isBoardComplete()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tablero incompleto',
                        text: 'Aún tienes cuadros por completar. ¡Llena todos los campos antes de finalizar!',
                    });
                    return;
                }

                if (!isBoardCorrect()) {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'El tablero no es correcto. Revisa tus respuestas.',
                    });
                    return;
                }

                clearInterval(interval); // Detener el cronómetro

                Swal.fire({
                    icon: 'success',
                    title: '¡Felicidades!',
                    text: 'Has completado el Sudoku correctamente. Guardando tu puntaje...',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    fetch('save_score.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            username: '<?= $username ?>',
                            difficulty: '<?= $difficulty ?>',
                            time_taken: elapsedSeconds
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Puntaje guardado',
                                text: 'Tu resultado ha sido registrado exitosamente.',
                            }).then(() => {
                                window.location.href = '<?= BASE_URL ?>views/index.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo guardar el puntaje. Inténtalo de nuevo.',
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al guardar tu puntaje.',
                        });
                    });
                });
            });
                
            // Mostrar solución
            solutionButton.addEventListener('click', () => {
                Swal.fire({
                    title: '¿Mostrar solución?',
                    text: 'Si revelas la solución, no podrás continuar jugando.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, mostrar',
                    cancelButtonText: 'Cancelar'
                }).then(result => {
                    if (result.isConfirmed) {
                        const solution = <?= json_encode($solution) ?>;
                        const cells = document.querySelectorAll('.sudoku-cell');
                        cells.forEach(cell => {
                            const row = parseInt(cell.dataset.row, 10);
                            const col = parseInt(cell.dataset.col, 10);
                            cell.value = solution[row][col];
                            cell.setAttribute('readonly', true);
                        });
                        Swal.fire({
                            icon: 'info',
                            title: 'Solución mostrada',
                            text: 'La solución se ha cargado correctamente.',
                        });
                    }
                });
            });
        });
    </script>
    <script>
        const solution = <?= json_encode($solution) ?>;
    </script>
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>