document.addEventListener('DOMContentLoaded', () => {
    const boardContainer = document.getElementById('sudoku-board');
    const hintButton = document.getElementById('hint-button');
    const finishButton = document.getElementById('finish-game');
    const solutionButton = document.getElementById('show-solution');
    const backToIndexButton = document.getElementById('back-to-index');
    const cells = document.querySelectorAll('.sudoku-cell');
    let hintsRemaining = 3;
    let solutionShown = false;

    const timeElapsedElement = document.getElementById('time-elapsed');
    let elapsedSeconds = 0;

    // Función para actualizar el cronómetro
    function updateTimer() {
        elapsedSeconds++;
        const minutes = Math.floor(elapsedSeconds / 60).toString().padStart(2, '0');
        const seconds = (elapsedSeconds % 60).toString().padStart(2, '0');
        timeElapsedElement.textContent = `${minutes}:${seconds}`;
    }

    // Iniciar cronómetro
    setInterval(updateTimer, 1000);

    // Resaltar fila, columna y bloque 3x3
    function highlightCells(row, col) {
        cells.forEach(cell => {
            const cellRow = parseInt(cell.dataset.row, 10);
            const cellCol = parseInt(cell.dataset.col, 10);

            // Quitar cualquier resaltado previo
            cell.classList.remove('highlight');

            // Resaltar fila, columna y bloque 3x3
            const isSameRow = cellRow === row;
            const isSameCol = cellCol === col;
            const isSameBlock =
                Math.floor(cellRow / 3) === Math.floor(row / 3) &&
                Math.floor(cellCol / 3) === Math.floor(col / 3);

            if (isSameRow || isSameCol || isSameBlock) {
                cell.classList.add('highlight');
            }
        });
    }

    // Evento de selección de celdas
    cells.forEach(cell => {
        cell.addEventListener('focus', () => {
            const row = parseInt(cell.dataset.row, 10);
            const col = parseInt(cell.dataset.col, 10);
            highlightCells(row, col);
        });

        cell.addEventListener('blur', () => {
            cells.forEach(c => c.classList.remove('highlight')); // Eliminar resaltado al perder foco
        });
    });
    
    // Validar número ingresado
    function isValidNumber(board, row, col, value) {
        // Verificar fila
        for (let c = 0; c < 9; c++) {
            if (c !== col && board[row][c] === value) return false;
        }

        // Verificar columna
        for (let r = 0; r < 9; r++) {
            if (r !== row && board[r][col] === value) return false;
        }

        // Verificar bloque 3x3
        const startRow = Math.floor(row / 3) * 3;
        const startCol = Math.floor(col / 3) * 3;
        for (let r = startRow; r < startRow + 3; r++) {
            for (let c = startCol; c < startCol + 3; c++) {
                if ((r !== row || c !== col) && board[r][c] === value) return false;
            }
        }

        return true;
    }

    // Recolectar datos del tablero actual
    function getBoard() {
        const board = Array.from({ length: 9 }, () => Array(9).fill(0));
        cells.forEach(cell => {
            const row = parseInt(cell.dataset.row, 10);
            const col = parseInt(cell.dataset.col, 10);
            const value = parseInt(cell.value, 10) || 0;
            board[row][col] = value;
        });
        return board;
    }

    // Evento de validación en tiempo real
    cells.forEach(cell => {
        cell.addEventListener('input', e => {
            const value = parseInt(e.target.value, 10) || 0;
            const row = parseInt(e.target.dataset.row, 10);
            const col = parseInt(e.target.dataset.col, 10);
            const board = getBoard();

            if (value > 0 && value <= 9 && isValidNumber(board, row, col, value)) {
                e.target.classList.remove('invalid');
            } else {
                e.target.classList.add('invalid');
            }
        });
    });

    // Validar entrada en las celdas del tablero
    const sudokuCells = document.querySelectorAll('.sudoku-cell');
    sudokuCells.forEach(cell => {
        cell.addEventListener('input', () => {
            const value = cell.value.trim(); // Quitar espacios
            if (!/^[1-9]$/.test(value)) { // Permitir sólo números del 1 al 9
                cell.value = ''; // Limpiar la entrada inválida
            }
        });
    });

    // Obtener el tablero actual
    function getCurrentBoard() {
        const board = Array.from({ length: 9 }, () => Array(9).fill(0));
        cells.forEach(cell => {
            const row = parseInt(cell.dataset.row, 10);
            const col = parseInt(cell.dataset.col, 10);
            const value = parseInt(cell.value, 10) || 0;
            board[row][col] = value;
        });
        return board;
    }

    // Buscar una celda vacía y sugerir un número válido
    function suggestHint(board, solution) {
        for (let row = 0; row < 9; row++) {
            for (let col = 0; col < 9; col++) {
                if (board[row][col] === 0) { // Celda vacía
                    return { row, col, value: solution[row][col] };
                }
            }
        }
        return null;
    }

    // Manejar clic en el botón de sugerencias
    hintButton.addEventListener('click', () => {
        if (hintsRemaining > 0) {
            const board = getCurrentBoard();
            const hint = suggestHint(board, solution);

            if (hint) {
                const cell = Array.from(cells).find(cell =>
                    parseInt(cell.dataset.row, 10) === hint.row &&
                    parseInt(cell.dataset.col, 10) === hint.col
                );
                cell.value = hint.value; // Rellenar la celda con la sugerencia
                cell.setAttribute('readonly', true); // Bloquear la celda
                hintsRemaining--;

                Swal.fire({
                    icon: 'info',
                    title: 'Sugerencia aplicada',
                    text: `Se ha rellenado una celda. Sugerencias restantes: ${hintsRemaining}`
                });
            }
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Sin sugerencias',
                text: 'Ya no tienes más sugerencias disponibles.'
            });
        }
    });
});