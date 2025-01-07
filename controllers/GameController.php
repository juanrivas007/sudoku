<?php
require_once __DIR__ . '/../models/Sudoku.php';

class GameController {
    public static function getGameBoard($difficulty) {
        return Sudoku::generateBoard($difficulty);
    }
}
?>
