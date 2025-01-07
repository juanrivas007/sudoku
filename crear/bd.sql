CREATE DATABASE sudoku;

USE sudoku;

-- Tabla para guardar tableros
CREATE TABLE sudoku_boards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    difficulty ENUM('easy', 'medium', 'hard') NOT NULL,
    board TEXT NOT NULL, -- Tablero inicial (en formato JSON o CSV)
    solution TEXT NOT NULL -- Solución del tablero
);

-- Tabla para guardar partidas (opcional)
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT DEFAULT NULL, -- Si implementamos usuarios
    board_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    status ENUM('in_progress', 'completed') NOT NULL,
    FOREIGN KEY (board_id) REFERENCES sudoku_boards(id)
);

CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard') NOT NULL,
    time_taken INT NOT NULL, -- Tiempo en segundos
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
