<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku - Inicio</title>
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
            <aside class="col-md-3 order-md-1 order-3">
                <div class="mb-4">
                    <h5 style="color: var(--licorice);">Ads</h5>
                    <div class="banner mb-3" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 150px; color: var(--licorice);">Banner 1</p>
                    </div>
                    
                    <div class="banner mb-3" id="google-ads" style="height: 300px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 300px; color: var(--licorice);">Google Ads</p>
                    </div>

                    <div class="banner mb-3" id="google-ads" style="height: 300px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                        <p class="text-center" style="line-height: 300px; color: var(--licorice);">Google Ads</p>
                    </div>                    
                </div>
            </aside>

            <!-- Contenido principal -->
            <main class="col-md-6 order-md-2 order-1">
                <!-- Encabezado -->
                <div class="text-center mb-5">
                    <h1 class="display-4" style="color: var(--bright-pink-crayola);">¡Bienvenido a Sudoku!</h1>
                    <p class="lead" style="color: var(--licorice);">Ingresa tu nombre y selecciona una dificultad para comenzar.</p>
                </div>

                <!-- Formulario de inicio -->
                <form id="start-form" class="mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label" style="color: var(--licorice);">Nombre de usuario:</label>
                                <input type="text" id="username" name="username" class="form-control" required maxlength="50" placeholder="Escribe tu nombre">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-difficulty="easy" class="btn btn-success mx-2 difficulty-btn" style="background-color: var(--bright-pink-crayola);">Fácil</button>
                        <button type="button" data-difficulty="medium" class="btn btn-warning mx-2 difficulty-btn" style="background-color: var(--vermilion);">Medio</button>
                        <button type="button" data-difficulty="hard" class="btn btn-danger mx-2 difficulty-btn" style="background-color: var(--rosewood);">Difícil</button>
                    </div>
                </form>

                <!-- Botón de reglas -->
                <div class="text-center mb-4">
                    <button class="btn btn-info btn-lg" style="background-color: var(--licorice); color: var(--lavender-blush);" data-bs-toggle="modal" data-bs-target="#rulesModal">Ver reglas del juego</button>
                </div>

                 <!-- Espacio para Google Ads -->
                 <div class="mb-4" id="google-ads-content" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                    <p class="text-center" style="line-height: 150px; color: var(--licorice);">Google Ads</p>
                </div>
                <div class="mb-4" id="google-ads-content" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                    <p class="text-center" style="line-height: 150px; color: var(--licorice);">Google Ads</p>
                </div>
                <div class="mb-4" id="google-ads-content" style="height: 150px; background-color: var(--lavender-blush); border: 1px dashed var(--licorice);">
                    <p class="text-center" style="line-height: 150px; color: var(--licorice);">Google Ads</p>
                </div>
                <!-- Modal de reglas -->
                <div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rulesModalLabel" style="color: var(--bright-pink-crayola);">Reglas del Sudoku</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body" style="color: var(--licorice);">
                                <p>El Sudoku es un juego de lógica en el que el objetivo es llenar una cuadrícula de 9x9 con números del 1 al 9.</p>
                                <ul>
                                    <li>Cada fila debe contener los números del 1 al 9 sin repetir.</li>
                                    <li>Cada columna debe contener los números del 1 al 9 sin repetir.</li>
                                    <li>Cada región de 3x3 (subcuadro) debe contener los números del 1 al 9 sin repetir.</li>
                                </ul>
                                <p>¡Resuelve el Sudoku respetando estas reglas y disfruta del desafío!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Sidebar derecho -->
            <aside class="col-md-3 order-md-3 order-2">
                <!-- Ranking Fácil -->
                <div class="mb-4">
                    <h5 style="color: var(--bright-pink-crayola); font-family: 'Arial Black', sans-serif;">Ranking Fácil</h5>
                    <ul class="list-group">
                        <?php
                        $query_easy = "SELECT username, time_taken FROM scores WHERE difficulty = 'easy' ORDER BY time_taken ASC LIMIT 5";
                        $result_easy = $conn->query($query_easy);
                        foreach ($result_easy as $index => $entry): ?>
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

                <!-- Ranking Medio -->
                <div class="mb-4">
                    <h5 style="color: var(--vermilion); font-family: 'Arial Black', sans-serif;">Ranking Medio</h5>
                    <ul class="list-group">
                        <?php
                        $query_medium = "SELECT username, time_taken FROM scores WHERE difficulty = 'medium' ORDER BY time_taken ASC LIMIT 5";
                        $result_medium = $conn->query($query_medium);
                        foreach ($result_medium as $index => $entry): ?>
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
                                <span class="badge" style="background-color: var(--vermilion); color: var(--lavender-blush); font-size: 1.2rem;">
                                    <?= gmdate('i:s', $entry['time_taken']) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Ranking Difícil -->
                <div class="mb-4">
                    <h5 style="color: var(--rosewood); font-family: 'Arial Black', sans-serif;">Ranking Difícil</h5>
                    <ul class="list-group">
                        <?php
                        $query_hard = "SELECT username, time_taken FROM scores WHERE difficulty = 'hard' ORDER BY time_taken ASC LIMIT 5";
                        $result_hard = $conn->query($query_hard);
                        foreach ($result_hard as $index => $entry): ?>
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
                                <span class="badge" style="background-color: var(--rosewood); color: var(--lavender-blush); font-size: 1.2rem;">
                                    <?= gmdate('i:s', $entry['time_taken']) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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
            const startForm = document.getElementById('start-form');
            const usernameInput = document.getElementById('username');
            const difficultyButtons = document.querySelectorAll('.difficulty-btn');

            // Evitar el envío del formulario con Enter
            startForm.addEventListener('submit', (e) => e.preventDefault());

            difficultyButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const username = usernameInput.value.trim();
                    const difficulty = button.getAttribute('data-difficulty');

                    if (!username) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Nombre requerido',
                            text: 'Por favor, ingresa tu nombre antes de seleccionar una dificultad.',
                        });
                        return;
                    }

                    Swal.fire({
                        title: '¿Estás listo?',
                        text: `Comenzarás el juego en dificultad ${difficulty.toUpperCase()}.`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, comenzar',
                        cancelButtonText: 'Cancelar'
                    }).then(result => {
                        if (result.isConfirmed) {
                            // Redirigir a la página del juego
                            window.location.href = `<?= BASE_URL ?>views/game.php?username=${encodeURIComponent(username)}&difficulty=${encodeURIComponent(difficulty)}`;
                        }
                    });
                });
            });
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
